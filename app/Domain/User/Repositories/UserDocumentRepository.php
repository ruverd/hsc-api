<?php

namespace App\Domain\User\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Domain\User\Entities\UserDocument;
use App\Domain\User\Contracts\UserDocumentRepositoryInterface;

class UserDocumentRepository extends BaseRepository implements UserDocumentRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return UserDocument::class;
    }
}
