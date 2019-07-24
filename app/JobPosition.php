<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobPosition extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'company_id'
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
        'name' => 'string',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp'
    ];

    /**
     * Get the JobAdverts for the JobPosition.
     */
    public function jobAdverts()
    {
        return $this->hasMany(\App\JobAdvert::class);
    }


    /**
     * Get the Company for the JobPosition.
     */
    public function company()
    {
        return $this->belongsTo(\App\Company::class);
    }

}
