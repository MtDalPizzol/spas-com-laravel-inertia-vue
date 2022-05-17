<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Course::class, 'course');
    }

    public function index()
    {
        return Inertia::render('CourseIndex', [
            'title' => 'Cursos',
            'courses' => Auth::user()->courses
        ]);
    }

    public function create()
    {
        return Inertia::render('CourseForm', [
            'action' => route('course.store'),
            'method' => 'post',
            'title' => 'Novo curso',
            'course' => new Course
        ]);
    }

    public function store(CourseRequest $request)
    {
        $course = Course::create($request->validated());

        return redirect()
            ->route('course.index')
            ->toast('Curso adicionado');
    }

    public function edit(Course $course)
    {
        return Inertia::render('CourseForm', [
            'action' => route('course.update', ['course' => $course->id]),
            'method' => 'put',
            'title' => 'Editando curso #' . $course->id,
            'course' => $course
        ]);
    }

    public function update(CourseRequest $request, Course $course)
    {
        $course->update($request->validated());

        return redirect()
            ->route('course.index')
            ->toast('Curso atualizado');
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return back()->toast('Curso excluído');
    }
}
