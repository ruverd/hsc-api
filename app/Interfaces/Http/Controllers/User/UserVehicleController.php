<?php

namespace App\Interfaces\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Infrastructure\Http\Controllers\BaseController;
use App\Domain\User\Resources\UserVehicleResource;
use App\Domain\User\Request\UserVehicleRequest;
use App\Domain\User\Contracts\UserVehicleRepositoryInterface;

class UserVehicleController extends BaseController
{
    protected $repository = null;

    public function __construct(UserVehicleRepositoryInterface $repository)
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
            UserVehicleResource::collection($this->repository->all()),
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
        $userVehicle = $this->repository->find($id);
        return $this->HTTPStatus::sendResponse(
            UserVehicleResource::make($userVehicle),
            $this->HTTPStatus::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Domain\User\Request\UserVehicleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserVehicleRequest $request)
    {
        $userVehicle = $this->repository->create($request->all());
        if(!$userVehicle){
            return $this->HTTPStatus::sendError($this->HTTPStatus::HTTP_NO_CONTENT);
        }
        return $this->HTTPStatus::sendResponse(
            UserVehicleResource::make($userVehicle),
            $this->HTTPStatus::HTTP_CREATED
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Domain\User\Request\UserVehicleRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserVehicleRequest $request, $id)
    {
        $userVehicle = $this->repository->find($id);
        if($userVehicle->update($request->all())){
            return $this->HTTPStatus::sendResponse(
                UserVehicleResource::make($userVehicle),
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
        $userVehicle = $this->repository->find($id);
        if($this->repository->delete($id)){
            return $this->HTTPStatus::sendResponse(
                UserVehicleResource::make($userVehicle),
                $this->HTTPStatus::HTTP_OK
            );
        }
    }
}
