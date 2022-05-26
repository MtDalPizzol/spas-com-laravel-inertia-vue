<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SectionController extends Controller
{
    public function index(Request $request, Course $course)
    {
        return Inertia::render('SectionIndex', [
            'course' => $course
        ]);
    }
}
