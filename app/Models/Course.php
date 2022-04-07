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

  protected $appends = ['url'];

  protected function cover(): Attribute
  {
    return Attribute::make(
      get: fn ($value) => ($value)
        ? Storage::disk('public')->url($value)
        : null
    );
  }

  protected function url(): Attribute
  {
    return Attribute::make(
      get: fn () => [
        'edit' => route('course.edit', [
          'course' => $this->id
        ])
      ]
    );
  }
}
