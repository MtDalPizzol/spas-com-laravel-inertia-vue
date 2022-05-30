<?php

namespace App\Http\Controllers;

use App\Http\Requests\SectionRequest;
use App\Models\Course;
use App\Models\Section;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SectionController extends Controller
{
    public function index(Request $request, Course $course)
    {
        return Inertia::render('SectionIndex', [
            'title' => 'Seções do curso #' . $course->id,
            'course' => $course,
            'sections' => $course->sections
        ]);
    }

    public function create(Request $request, Course $course)
    {
        return Inertia::render('SectionForm', [
            'title' => 'Nova seção',
            'course' => $course,
            'section' => new Section,
            'method' => 'post',
            'action' => route('course.section.store', [
                'course' => $course->id
            ])
        ]);
    }

    public function store(SectionRequest $request, Course $course)
    {
        Section::create($request->validated());

        return redirect($course->url['section']['index']);
    }
}
