<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'class_id',
        'teacher_id',
        'student_id',
    ];

    /**
     * Get the schedule associated with the class.
     */
    public function class()
    {
        return $this->belongsTo(Classes::class);
    }
}
