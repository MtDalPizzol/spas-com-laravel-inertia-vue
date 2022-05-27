<?php

namespace App\Http\Controllers;

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
            'course' => $course
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
}
