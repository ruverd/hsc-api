<?php

namespace App\Interfaces\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Infrastructure\Http\Controllers\BaseController;
use App\Domain\User\Resources\UserStatusResource;
use App\Domain\User\Request\UserStatusRequest;
use App\Domain\User\Contracts\UserStatusRepositoryInterface;

class UserStatusController extends BaseController
{
    protected $repository = null;

    public function __construct(UserStatusRepositoryInterface $repository)
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
        return $this->HTTPStatus::sendResponse(
            UserStatusResource::collection($this->repository->all()),
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
        $userStatus = $this->repository->find($id);
        return $this->HTTPStatus::sendResponse(
            UserStatusResource::make($userStatus),
            $this->HTTPStatus::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Domain\User\Request\UserStatusRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStatusRequest $request)
    {
        $userStatus = $this->repository->create($request->all());
        if(!$userStatus){
            return $this->HTTPStatus::sendError($this->HTTPStatus::HTTP_NO_CONTENT);
        }
        return $this->HTTPStatus::sendResponse(
            UserStatusResource::make($userStatus),
            $this->HTTPStatus::HTTP_CREATED
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Domain\User\Request\UserStatusRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserStatusRequest $request, $id)
    {
        $userStatus = $this->repository->find($id);
        if($userStatus->update($request->all())){
            return $this->HTTPStatus::sendResponse(
                UserStatusResource::make($userStatus),
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
        $userStatus = $this->repository->find($id);
        if($this->repository->delete($id)){
            return $this->HTTPStatus::sendResponse(
                UserStatusResource::make($userStatus),
                $this->HTTPStatus::HTTP_OK
            );
        }
    }
}
