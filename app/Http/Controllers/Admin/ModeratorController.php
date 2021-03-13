<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ModeratorStoreRequest;
use App\Models\Advisor;
use App\Models\Moderator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ModeratorController extends Controller
{
    public function index()
    {
        $moderators = Moderator::all();
        return view('moderator.index', compact('moderators'));
    }

    public function create()
    {
        return view('moderator.create');
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), (new Moderator())->rules());
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
                'email' => $email,
                'password' => $password,
                'phone' => $request->phone,
            ]);
            $moderator = new Moderator();
            $moderator->user_id = $user->id;
            $moderator->is_active = true;
            $moderator->fill($request->all());
            $moderator->save();

            DB::commit();
            $request->session()->flash('success', 'Вы успешно добавили модератора!');
            return redirect(route('moderator.index'));

        } catch (\Exception $exception) {
            DB::rollback();
            $request->session()->flash('danger', [1 => $exception->getMessage()]);
            return back()->withInput();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Moderator $moderator
     * @return \Illuminate\Http\Response
     */
    public function show(Moderator $moderator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Moderator $moderator
     * @return \Illuminate\Http\Response
     */
    public function edit(Moderator $moderator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Moderator $moderator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Moderator $moderator)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Moderator $moderator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Moderator $moderator)
    {
        //
    }
}
