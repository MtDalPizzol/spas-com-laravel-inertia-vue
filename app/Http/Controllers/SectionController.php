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
        $this->authorize('viewAny', [Section::class, $course]);

        return Inertia::render('SectionIndex', [
            'title' => 'Seções do curso #' . $course->id,
            'course' => $course,
            'sections' => $course->sections
        ]);
    }

    public function create(Request $request, Course $course)
    {
        $this->authorize('create', [Section::class, $course]);

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

    public function edit(Request $request, Course $course, Section $section)
    {
        $this->authorize('update', $section);

        return Inertia::render('SectionForm', [
            'title' => 'Editando seção #' . $section->id,
            'course' => $course,
            'section' => $section,
            'method' => 'put',
            'action' => $section->url['edit']
        ]);
    }

    public function update(SectionRequest $request, Course $course, Section $section)
    {
        $section->update($request->validated());

        return redirect($course->url['section']['index'])
            ->toast('Seção atualizada');
    }

    public function destroy(Request $request, Course $course, Section $section)
    {
        $this->authorize('delete', $section);

        $section->delete();

        return back()->toast('Seção excluída');
    }
}
