<?php

namespace App\Interfaces\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Infrastructure\Http\Controllers\BaseController;
use App\Domain\User\Resources\UserResource;
use App\Domain\User\Request\UserPasswordRequest;
use App\Domain\User\Contracts\UserRepositoryInterface;
use App\Domain\User\Entities\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserPasswordController extends BaseController
{
    protected $repository = null;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Domain\User\Request\UserPasswordRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserPasswordRequest $request)
    {
        $user = User::find(Auth::id());
        $user->password = Hash::make($request->password);
        $user->save();
        
        if($user->save()){
            return $this->HTTPStatus::sendResponse(
                UserResource::make($user),
                $this->HTTPStatus::HTTP_ACCEPTED
            );
        }
    }
}
