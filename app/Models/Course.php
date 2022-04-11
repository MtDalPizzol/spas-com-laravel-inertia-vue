<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Course extends Model
{
  use HasFactory;

  // protected $guarded = [];

  protected $fillable = [
    'title',
    'description',
    'cover'
  ];

  protected $attributes = [
    'title' => null,
    'description' => '',
    'cover' => null
  ];

  protected $appends = ['url', 'cover_url'];

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
          : null
      ]
    );
  }
}
