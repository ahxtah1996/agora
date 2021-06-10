<?php

namespace App\Repositories\User;

use App\Repositories\RepositoryAbstract;
use Illuminate\Support\Facades\Storage;
use File;
use Validator;
use DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRepository extends RepositoryAbstract implements UserRepositoryInterface
{
    /**
     * Construct
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->modelName = 'user';
        $this->model = new User;
        $this->table = 'users';
    }

    /**
     * Store not me.
     *
     * @param array $data
     *
     * @return
     */
    public function storeNotMe()
    {
        return $this->model->where('id', '<>', Auth::id())->get();
    }
}