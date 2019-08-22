<?php

namespace App\Interfaces\Http\Controllers\Register;

use Illuminate\Http\Request;
use App\Infrastructure\Http\Controllers\BaseController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Domain\User\Resources\UserResource;
use App\Domain\User\Request\UserRequest;
use App\Domain\User\Contracts\UserRepositoryInterface;

class PersonalController extends BaseController
{
    use AuthenticatesUsers;

    protected $repository = null;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->repository->findById('user_id',$id);
        return $this->HTTPStatus::sendResponse(
            UserDocumentResource::make($user),
            $this->HTTPStatus::HTTP_OK
        );
    }
}
