<?php

use App\Models\Student;
use App\Models\Course;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

Route::get('/', function () {
    return redirect('/students');
});

/* ================= STUDENT ROUTES ================= */

Route::get('/students', function () {
    return view('student.list', ['students' => Student::all()]);
})->name('students.index');

Route::get('/students/create', function () {
    return view('student.create');
});

Route::post('/students', function (Request $request) {
    $validated = $request->validate([
        'name'          => 'required|string|max:255',
        'email'         => 'required|email|max:255|unique:students,email',
        'phone'         => 'required|string|max:20',
        'address'       => 'nullable|string|max:500',
        'date_of_birth' => 'nullable|date',
    ]);

    $student = Student::create($validated);

    return redirect()->route('students.index')
        ->with('success', "Student {$student->name} created successfully!");
});

Route::get('/students/{id}', function ($id) {
    return view('student.detail', ['student' => Student::findOrFail($id)]);
});

Route::get('/students/{id}/edit', function ($id) {
    return view('student.edit', ['student' => Student::findOrFail($id)]);
});

Route::put('/students/{id}', function (Request $request, $id) {
    $student = Student::findOrFail($id);

    $validated = $request->validate([
        'name'          => 'required|string|max:255',
        'email'         => ['required', 'email', 'max:255', Rule::unique('students')->ignore($student->id)],
        'phone'         => 'required|string|max:20',
        'address'       => 'nullable|string|max:500',
        'date_of_birth' => 'nullable|date',
    ]);

    $student->update($validated);

    return redirect('/students/' . $student->id)
        ->with('success', 'Student updated successfully!');
});

Route::delete('/students/{id}', function ($id) {
    Student::findOrFail($id)->delete();
    return redirect('/students')->with('success', 'Student deleted successfully!');
});

/* ================= COURSE ROUTES ================= */

Route::get('/courses', function () {
    return view('course.list', ['courses' => Course::all()]);
})->name('courses.index');

Route::get('/courses/create', function () {
    return view('course.create');
});

Route::post('/courses', function (Request $request) {
    $validated = $request->validate([
        'name'        => 'required|string|max:255',
        'description' => 'nullable|string',
        'duration'    => 'required|integer|min:1',
        'fee'         => 'required|numeric|min:0',
        'difficulty'  => 'required|in:Easy,Medium,Hard',
        'is_active'   => 'nullable|boolean',
    ]);

    $validated['is_active'] = $request->has('is_active');
    $course = Course::create($validated);

    return redirect()->route('courses.index')
        ->with('success', "Course {$course->name} created successfully!");
});

Route::get('/courses/{id}', function ($id) {
    return view('course.detail', ['course' => Course::findOrFail($id)]);
});

Route::get('/courses/{id}/edit', function ($id) {
    return view('course.edit', ['course' => Course::findOrFail($id)]);
});

Route::put('/courses/{id}', function (Request $request, $id) {
    $course = Course::findOrFail($id);

    $validated = $request->validate([
        'name'        => 'required|string|max:255',
        'description' => 'nullable|string',
        'duration'    => 'required|integer|min:1',
        'fee'         => 'required|numeric|min:0',
        'difficulty'  => 'required|in:Easy,Medium,Hard',
        'is_active'   => 'nullable|boolean',
    ]);

    $validated['is_active'] = $request->has('is_active');
    $course->update($validated);

    return redirect('/courses/' . $course->id)->with('success', 'Course updated successfully!');
});

Route::delete('/courses/{id}', function ($id) {
    Course::findOrFail($id)->delete();
    return redirect('/courses')->with('success', 'Course deleted successfully!');
});