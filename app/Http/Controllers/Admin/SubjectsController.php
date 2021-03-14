<?php

namespace App\Http\Controllers\Admin;

use App\Models\Group;
use App\Http\Controllers\Controller;
use App\Models\Subjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $subjects = Subjects::all();
        return view('subject.index', ['subjects' => $subjects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('subject.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), ['title' => 'required|unique:subjects']);
        if ($validation->fails()) {
            $request->session()->flash('danger', $validation->errors()->all());
            return back()->withInput();
        }

        try {
            DB::beginTransaction();
            $subject = new Subjects();
            $subject->fill($request->all());
            $subject->save();

            $group = new Group();
            $group->name = sprintf('Группа "%s"', $subject->title);
            $group->subject_id = $subject->id;
            $group->is_active = true;
            $group->save();

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            $request->session()->flash('danger', [1 => $exception->getMessage()]);
        }


        return redirect(route('subject.index'));

    }

    public function edit(Subjects $subject)
    {
        return view('subject.edit', compact('subject'));
    }

    public function update(Request $request, Subjects $subject)
    {
        $validation = Validator::make($request->all(), ['title' => 'required']);
        if ($validation->fails()) {
            $request->session()->flash('danger', $validation->errors()->all());
            return back()->withInput();
        }
        try {
            DB::beginTransaction();
            $subject->fill($request->all());
            $subject->save();

            $group = Group::where(['subject_id' => $subject->id])->first();
            $group->name = sprintf('Группа "%s"', $subject->title);
            $group->save();

            DB::commit();

            session()->flash('success', 'Вы успешно редактировали предмет!');
            return redirect(route('subject.index'));
        } catch (\Exception $exception) {
            DB::rollBack();
            $request->session()->flash('danger', [1 => $exception->getMessage()]);
        }
    }

    public function destroy(Subjects $subject)
    {
        try {
            DB::beginTransaction();
            if (isset($subject->group)) {
                $subject->group->delete();
            }
            $subject->delete();
            DB::commit();
            session()->flash('success', 'Вы успешно удалили предмет!');
            return redirect(route('subject.index'));

        } catch (\Exception $exception) {
            DB::rollBack();
            session()->flash('danger', [1 => $exception->getMessage()]);
            return back()->withInput();
        }
    }
}
