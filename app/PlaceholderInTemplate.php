<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlaceholderInTemplate extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'model_class', 'placeholder_text', 'mapped_property'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'model_class' => 'string',
        'placeholder_text' => 'string',
        'mapped_property' => 'string',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp'
    ];
}
