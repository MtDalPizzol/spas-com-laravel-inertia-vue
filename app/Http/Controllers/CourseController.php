<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CourseController extends Controller
{
  public function index()
  {
    return Inertia::render('CourseIndex', [
      'title' => 'Cursos',
      'courses' => Course::all()
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

  public function store()
  {
    $validated = request()->validate([
      'title' => ['required', 'string', 'min:3', 'max:255'],
      'description' => ['required', 'string', 'min:3'],
      'cover_file' => ['nullable', 'file', 'image', 'max:2048']
    ]);

    if (!empty($validated['cover'])) {
      $validated['cover'] = $validated['cover']->store('courses', 'public');
    }

    Course::create($validated);

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

  public function update(Course $course)
  {
    $validated = request()->validate([
      'title' => ['required', 'string', 'min:3', 'max:255'],
      'description' => ['required', 'string', 'min:3'],
      'cover_file' => ['nullable', 'file', 'image', 'max:2048']
    ]);

    if (!empty($validated['cover'])) {
      $validated['cover'] = $validated['cover']->store('courses', 'public');
    }

    $course->update($validated);

    return redirect()
      ->route('course.index')
      ->toast('Curso atualizado');
  }
}
