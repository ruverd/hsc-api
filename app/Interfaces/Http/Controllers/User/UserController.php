<?php

namespace App\Interfaces\Http\Controllers\User;

use App\Domain\User\Contracts\UserRepositoryInterface;
use App\Domain\User\Request\UserRequest;
use App\Domain\User\Resources\UserResource;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Infrastructure\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    use AuthenticatesUsers;

    protected $repository = null;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Resource
     */
    public function index(Request $request)
    {
        $status = ((int) $this->guard()->user()->profile_id === 2) ? [2] : [3];

        return $this->HTTPStatus::sendResponse(
            UserResource::collection($this->repository->findWhereIn('user_status_id', $status)),
            $this->HTTPStatus::HTTP_OK
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->repository->find($id);

        return $this->HTTPStatus::sendResponse(
            UserResource::make($user),
            $this->HTTPStatus::HTTP_OK
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getByProfile($profileId)
    {
        $user = $this->repository->findByField();

        return $this->HTTPStatus::sendResponse(
            UserResource::make($user),
            $this->HTTPStatus::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Domain\User\Request\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = $this->repository->create($request->all());

        if (!$user)
            return $this->HTTPStatus::sendError($this->HTTPStatus::HTTP_NO_CONTENT);

        return $this->HTTPStatus::sendResponse(
            UserResource::make($user),
            $this->HTTPStatus::HTTP_CREATED
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Illuminate\Http\Request;  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = $this->repository->find($id);

        if ($user->update($request->all())) {
            return $this->HTTPStatus::sendResponse(
                UserResource::make($user),
                $this->HTTPStatus::HTTP_ACCEPTED
            );
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Domain\User\Request\UserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(UserRequest $request, $id)
    {
        $user = $this->repository->find($id);

        if ($user->update($request->all())) {
            return $this->HTTPStatus::sendResponse(
                UserResource::make($user),
                $this->HTTPStatus::HTTP_ACCEPTED
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->repository->find($id);

        if ($this->repository->delete($id)) {
            return $this->HTTPStatus::sendResponse(
                UserResource::make($user),
                $this->HTTPStatus::HTTP_OK
            );
        }
    }
}
