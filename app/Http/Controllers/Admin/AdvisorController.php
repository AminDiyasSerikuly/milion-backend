<?php

namespace App\Http\Controllers\Admin;

use App\Advisor;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\Input;

class AdvisorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $advisors = Advisor::where(['is_active' => true])->get();
        return view('advisor.index', ['advisors' => $advisors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('advisor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $requests
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), (new \App\Advisor)->rules());
        if ($validation->fails()) {
            $request->session()->flash('danger', $validation->errors()->all());
            return back()->withInput();
        }
        $email = Str::random(8) . '@milion.com';
        $password = Hash::make('62hello_world');

        try {
            DB::beginTransaction();
            $user = User::create([
                'name' => $request->first_name,
                'email' => 'default@mail.com',
                'password' => $password,
            ]);
            $advisor = new Advisor();
            $advisor->user_id = $user->id;
            $advisor->is_active = true;
            $advisor->fill($request->all());
            $advisor->save();
            DB::commit();
            $request->session()->flash('success', 'Вы успешно добавили куратора!');
            return redirect(route('advisor.index'));

        } catch (\Exception $exception) {
            DB::rollback();
            $request->session()->flash('danger', [1 => $exception->getMessage()]);
            return back()->withInput();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Advisor $advisor
     * @return \Illuminate\Http\Response
     */
    public function show(Advisor $advisor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Advisor $advisor
     * @return \Illuminate\Http\Response
     */
    public function edit(Advisor $advisor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Advisor $advisor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Advisor $advisor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Advisor $advisor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advisor $advisor)
    {
        //
    }
}
