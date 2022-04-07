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
      'title' => 'Novo curso'
    ]);
  }

  public function store()
  {
    $validated = request()->validate([
      'title' => ['required', 'string', 'min:3', 'max:255'],
      'description' => ['required', 'string', 'min:3'],
      'cover' => ['nullable', 'file', 'image', 'max:2048']
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
      'title' => 'Editando curso #' . $course->id
    ]);
  }
}
