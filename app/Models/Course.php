<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Course extends Model
{
    use HasFactory;

    // protected $guarded = [];

    protected $fillable = [
        'title',
        'description'
    ];

    protected $attributes = [
        'title' => null,
        'description' => '',
        'cover' => null
    ];

    protected $appends = ['url', 'cover_url'];

    protected static function booted()
    {
        static::saving(function ($course) {
            if (!$course->id) {
                return static::onCreating($course);
            }

            return static::onUpdating($course);
        });

        static::deleting(function ($course) {
            $course->deleteCoverFile();
        });
    }

    protected static function onCreating($course)
    {
        $course->instructor_id = Auth::id();

        $request = request();

        if (!empty($request->cover_file)) {
            $course->addCover($request->cover_file);
        }
    }

    protected static function onUpdating($course)
    {
        $request = request();

        if ($course->mustRemoveCover($request->cover_file, $request->cover)) {
            $course->removeCover();
        }

        if (!empty($request->cover_file)) {
            $course->addCover($request->cover_file);
        }
    }

    protected function coverUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => ($this->cover)
                ? Storage::disk('public')->url($this->cover)
                : null
        );
    }

    protected function url(): Attribute
    {
        return Attribute::make(
            get: fn () => [
                'edit' => ($this->id)
                    ? route('course.edit', ['course' => $this->id])
                    : null,
                'section' => [
                    'index' => ($this->id)
                        ? route('course.section.index', ['course' => $this->id])
                        : null,
                ]
            ]
        );
    }

    public function hasCover()
    {
        return (!empty($this->cover) && Storage::disk('public')->exists($this->cover));
    }

    public function mustRemoveCover($uploadedFile, $currentPath)
    {
        return (!empty($uploadedFile)
            || (empty($uploadedFile) && empty($currentPath)))
            && $this->hasCover();
    }

    public function deleteCoverFile()
    {
        if (!$this->cover) {
            return;
        }

        return Storage::disk('public')->delete($this->cover);
    }

    public function removeCover()
    {
        $this->deleteCoverFile();

        $this->cover = null;

        return $this;
    }

    public function addCover(UploadedFile $file)
    {
        $this->cover = $file->store('courses', 'public');

        return $this;
    }

    public function instructor()
    {
        return $this->belongsTo(User::class);
    }
}
