<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
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
     * Get the JobPositions for the Company.
     */
    public function jobPositions()
    {
        return $this->hasMany(\App\JobPosition::class);
    }


    /**
     * Get the EmailTemplates for the Company.
     */
    public function emailTemplates()
    {
        return $this->hasMany(\App\EmailTemplate::class);
    }

}
