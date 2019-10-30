<?php

namespace App\Domain\User\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Domain\User\Entities\User;
use App\Domain\User\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return User::class;
    }

    public function avgApproveDays()
    {
        $query = $this->model
                    ->select(DB::raw('AVG(TIMESTAMPDIFF(DAY,registered,approved)) AS days'))
                    ->get();

        foreach ($query as $obj) {
            return (int) $obj['days'];
        }

        return 0;
    }
}
