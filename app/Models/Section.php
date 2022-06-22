<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'title'
    ];

    protected $attributes = [
        'title' => null
    ];

    protected $appends = [
        'url'
    ];

    public static function booted()
    {
        static::saving(function ($section) {
            if (!$section->id) {
                static::onCreating($section);
            }
        });
    }

    public static function onCreating($section)
    {
        $section->course_id = request()->course->id;
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function url(): Attribute
    {
        return Attribute::make(
            get: fn () => [
                'edit' => $this->id
                    ? route('course.section.edit', [
                        'course' => $this->course->id,
                        'section' => $this->id
                    ])
                    : null,
                'update' => $this->id
                    ? route('course.section.update', [
                        'course' => $this->course->id,
                        'section' => $this->id
                    ])
                    : null,
                'destroy' => $this->id
                    ? route('course.section.destroy', [
                        'course' => $this->course->id,
                        'section' => $this->id
                    ])
                    : null
            ]
        );
    }
}
