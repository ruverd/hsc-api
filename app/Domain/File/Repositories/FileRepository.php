<?php

namespace App\Domain\File\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Domain\File\Entities\File;
use App\Domain\File\Contracts\FileRepositoryInterface;

class FileRepository extends BaseRepository implements FileRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return File::class;
    }
}
