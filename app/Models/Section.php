<?php

namespace App\Models;

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
}
