<?php

namespace App\Interfaces\Http\Controllers\Register;

use Illuminate\Http\Request;
use App\Infrastructure\Http\Controllers\BaseController;
use App\Domain\User\Resources\UserResource;
use App\Domain\User\Contracts\UserRepositoryInterface;
use Carbon\Carbon;

class RegisterController extends BaseController
{
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
    public function completed($id)
    {
        $user = $this->repository->find($id);
        $dateToday = Carbon::today()->toDateString();

        if($user->update([ 'registered' => $dateToday, 'user_status_id' => 2 ])){
            return $this->HTTPStatus::sendResponse(
                UserResource::make($user),
                $this->HTTPStatus::HTTP_ACCEPTED
            );
        }
    }
}
