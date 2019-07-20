<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobAdvert extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'job_position_id'
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
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp'
    ];

    /**
     * Get the JobPosition for the JobAdvert.
     */
    public function jobPosition()
    {
        return $this->belongsTo(\App\JobPosition::class);
    }

}
