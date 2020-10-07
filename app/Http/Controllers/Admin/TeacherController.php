<?php

namespace App\Http\Controllers\Admin;

use App\Advisor;
use App\Teacher;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $teachers = Teacher::where(['is_active' => true])->get();
        return view('teacher.index', ['teachers' => $teachers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('teacher.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), (new \App\Teacher())->rules());
        if ($validation->fails()) {
            $request->session()->flash('danger', $validation->errors()->all());
            return back()->withInput();
        }
        $password = Hash::make('62hello_world');
        $email = Str::random(8) . '@milion.com';

        try {
            DB::beginTransaction();
            $user = User::create([
                'name' => $request->first_name,
                'email' => $email,
                'password' => $password,
            ]);
            $teacher = new Teacher();
            $teacher->user_id = $user->id;
            $teacher->is_active = true;
            $teacher->fill($request->all());
            $teacher->save();

            $user->assignRole('teacher');

            DB::commit();
            $request->session()->flash('success', 'Вы успешно добавили учителя!');
            return redirect(route('teacher.create'));

        } catch (\Exception $exception) {
            DB::rollback();
            $request->session()->flash('danger', [1 => $exception->getMessage()]);
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Teacher $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Teacher $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Teacher $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Teacher $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        //
    }
}
