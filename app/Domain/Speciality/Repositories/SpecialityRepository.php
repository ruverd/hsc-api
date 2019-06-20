<?php

namespace App\Domain\Speciality\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Domain\Speciality\Entities\Speciality;
use App\Domain\Speciality\Contracts\SpecialityRepositoryInterface;

class SpecialityRepository extends BaseRepository implements SpecialityRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return Speciality::class;
    }
}
