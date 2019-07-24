<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class JobApplication extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $guarded = ['id'];

    public function registerMediaCollections()
    {
        $this
            ->addMediaCollection('cv')
            ->singleFile();
    }

    public function jobAdvert()
    {
        return $this->belongsTo(\App\JobAdvert::class);
    }
}
