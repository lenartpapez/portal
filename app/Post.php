<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Post extends Model implements HasMedia
{
    use HasMediaTrait;

    /**
     * @param Media|null $media
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('smallThumb')->fit('crop', 150, 150);
        $this->addMediaConversion('thumb')->fit('crop', 300, 300);
        $this->addMediaConversion('bigThumb')->fit('crop', 600, 600);
        $this->addMediaConversion('hd')->width(1920);
        $this->addMediaConversion('medium')->width(1200);
        $this->addMediaConversion('extraLarge')->fit('crop', 1920, 600);
        $this->addMediaConversion('large')->fit('crop', 1200, 600);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
