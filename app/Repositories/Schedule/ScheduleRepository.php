<?php

namespace App\Repositories\Schedule;

use App\Repositories\RepositoryAbstract;
use Illuminate\Support\Facades\Storage;
use File;
use Validator;
use DB;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;

class ScheduleRepository extends RepositoryAbstract implements ScheduleRepositoryInterface
{
    /**
     * Construct
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->modelName = 'schedule';
        $this->model = new Schedule;
        $this->table = 'schedules';
    }

    /**
     * Get schedule.
     *
     *
     * @return
     */
    public function schedule()
    {
        $classes = $this->model
            ->where('teacher_id', '=', Auth::id())
            ->orWhere('student_id', '=', Auth::id())
            ->groupBy('class_id')
            ->get('class_id');

        $arr = [];
        foreach ($classes as $val) {
            array_push($arr, $val->class);
        }
        return $arr;
    }
}