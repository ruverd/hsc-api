<?php

namespace App\Interfaces\Http\Controllers\Register;

use Illuminate\Http\Request;
use App\Infrastructure\Http\Controllers\BaseController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Domain\User\Resources\UserVehicleResource;
use App\Domain\User\Request\UserVehicleRequest;
use App\Domain\User\Contracts\UserVehicleRepositoryInterface;

class VehicleController extends BaseController
{
    use AuthenticatesUsers;

    protected $repository = null;

    public function __construct(UserVehicleRepositoryInterface $repository)
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
        $vehicle = $this->repository->findByField('user_id',$id);
        return $this->HTTPStatus::sendResponse(
            UserVehicleResource::make($vehicle),
            $this->HTTPStatus::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Illuminate\Http\Request;  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vehicle = $this->repository->create($request->all());

        if(!$vehicle){
            return $this->HTTPStatus::sendError($this->HTTPStatus::HTTP_NO_CONTENT);
        }
        return $this->HTTPStatus::sendResponse(
            UserVehicleResource::make($vehicle),
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
        $vehicle = $this->repository->find($id);

        if($vehicle->update($request->all())){
            return $this->HTTPStatus::sendResponse(
                UserVehicleResource::make($vehicle),
                $this->HTTPStatus::HTTP_ACCEPTED
            );
        }
    }
}
