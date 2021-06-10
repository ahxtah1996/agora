<?php

namespace App\Repositories\Class;

use App\Repositories\RepositoryAbstract;
use Illuminate\Support\Facades\Storage;
use File;
use Validator;
use DB;
use App\Models\Classes;
use Illuminate\Support\Facades\Auth;

class ClassRepository extends RepositoryAbstract implements ClassRepositoryInterface
{
    /**
     * Construct
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->modelName = 'class';
        $this->model = new Classes;
        $this->table = 'classes';
    }
}