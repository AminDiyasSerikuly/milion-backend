<?php

namespace App\Http\Controllers\Admin;

use App\Models\Advisor;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Subjects;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $students = Student::all();
        return view('students.index', ['students' => $students]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), (new Student())->rules());
        if ($validation->fails()) {
            $request->session()->flash('danger', $validation->errors()->all());
            return back()->withInput();
        }

        try {
            DB::begintransaction();
            $email = Str::random(8);
            $email = $email . '@milion.com';
            $password = '62hello_world';
            $password = Hash::make($password);

            $user = User::create([
                'name' => $request->name,
                'email' => $email,
                'password' => $password,
            ]);

            $user->assignRole('student');

            $student = new Student();
            $student->fill($request->all());
            $student->user_id = $user->id;
            $student->save();

            $subjects = Subjects::whereIn('id', $request->subject)->get();

            foreach ($subjects as $subject) {
                DB::table('student_subject')->insert([
                    'student_id' => $student->id,
                    'subject_id' => $subject->id,
                ]);

                if (!isset($subject->group)) {
                    $request->session()->flash('danger', [1 => 'Группа предмета не существует!']);
                    return redirect(route('student.index'));
                }

                DB::table('group_student')->insert([
                    'student_id' => $student->id,
                    'group_id' => $subject->group->id,
                ]);
            }


            DB::commit();

            $request->session()->flash('success', 'Вы успешно добавили студента!');
            return redirect(route('student.index'));

        } catch (\Exception $e) {
            DB::rollback();
            $request->session()->flash('danger', [1 => $e->getMessage()]);
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Student $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Student $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Student $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Student $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}