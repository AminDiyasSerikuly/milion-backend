<?php

namespace App\Http\Controllers\Admin;


use App\Models\Teacher;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::where(['is_active' => true])->get();
        return view('teacher.index', ['teachers' => $teachers]);
    }

    public function create()
    {
        return view('teacher.create');
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), (new Teacher())->rules());
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
                'phone' => $request->phone,
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
}
