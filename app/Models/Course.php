<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
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
    return Storage::disk('public')->delete($this->cover);
  }

  public function removeCover()
  {
    $this->deleteCoverFile();

    $this->cover = null;

    return $this->save();
  }

  public function addCover(UploadedFile $file)
  {
    $this->cover = $file->store('courses', 'public');

    return $this->save();
  }
}
