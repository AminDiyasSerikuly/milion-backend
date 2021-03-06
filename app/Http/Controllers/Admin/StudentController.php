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
        $phone = (str_replace(['-', '(', ')', ' ', '+'], '', $request->phone));
        $request->merge([
            'phone' => $phone,
        ]);
        $data = $request;

        $validation = Validator::make($data->all(), (new Student())->rules());
        if ($validation->fails()) {
            $data->session()->flash('danger', $validation->errors()->all());
            return back()->withInput();
        }

        try {
            DB::begintransaction();
            $email = Str::random(8);
            $email = $email . '@milion.com';
            $password = '62hello_world';
            $password = Hash::make($password);


            $user = User::create([
                'name' => $data->name,
                'email' => $email,
                'password' => $password,
                'phone' => $data->phone,
            ]);

            $user->assignRole('student');

            $student = new Student();
            $student->fill($data->all());
            $student->phone = $phone;
            $student->user_id = $user->id;
            $student->save();

            $subjects = Subjects::whereIn('id', $data->subject)->get();

            foreach ($subjects as $subject) {
                DB::table('student_subject')->insert([
                    'student_id' => $student->id,
                    'subject_id' => $subject->id,
                ]);

                if (!isset($subject->group)) {
                    $data->session()->flash('danger', [1 => 'Группа предмета не существует!']);
                    return redirect(route('student.index'));
                }

                DB::table('group_student')->insert([
                    'student_id' => $student->id,
                    'group_id' => $subject->group->id,
                ]);
            }


            DB::commit();

            $data->session()->flash('success', 'Вы успешно добавили студента!');
            return redirect(route('student.index'));

        } catch (\Exception $e) {
            DB::rollback();
            $data->session()->flash('danger', [1 => $e->getMessage()]);
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

    public function destroy(Student $student)
    {
        if ($student->delete()) {
            session()->flash('success', 'Вы успешно удалили!');
        }
        session()->flash('danger', 'Поизошла ошибка при удаление!');
        return redirect(route('student.index'));
    }

    public function debt(Request $request)
    {
        $debt = $request->debt;
        $user = User::find($request->id);
        $user->debt = $debt;
        $user->save();
        session()->flash('success', 'Вы успешно добавили задолжность!');
        return redirect(route('student.index'));
    }
}
