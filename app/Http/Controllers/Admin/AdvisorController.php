<?php

namespace App\Http\Controllers\Admin;

use App\Models\Advisor;
use App\Http\Controllers\Controller;
use App\Models\User;
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
        $phone = (str_replace(['-', '(', ')', ' ', '+'], '', $request->phone));
        $request->merge([
            'phone' => $phone,
        ]);
        $data = $request;

        $validation = Validator::make($data->all(), (new Advisor)->rules());
        if ($validation->fails()) {
            $data->session()->flash('danger', $validation->errors()->all());
            return back()->withInput();
        }
        $email = Str::random(8) . '@milion.com';
        $password = Hash::make('62hello_world');


        try {
            DB::beginTransaction();
            $user = User::create([
                'name' => $data->first_name,
                'email' => $email,
                'password' => $password,
                'phone' => $data->phone,
            ]);
            $advisor = new Advisor();
            $advisor->user_id = $user->id;
            $advisor->is_active = true;
            $advisor->fill($data->all());
            $advisor->phone = $phone;
            $advisor->save();

            $user->assignRole('advisor');

            DB::commit();
            $data->session()->flash('success', 'Вы успешно добавили куратора!');
            return redirect(route('advisor.index'));

        } catch (\Exception $exception) {
            DB::rollback();
            $data->session()->flash('danger', [1 => $exception->getMessage()]);
            return back()->withInput();
        }

    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Advisor $advisor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
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
