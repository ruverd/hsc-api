<?php

namespace App\Interfaces\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Infrastructure\Http\Controllers\BaseController;
use App\Domain\User\Resources\UserOfficeResource;
use App\Domain\User\Request\UserOfficeRequest;
use App\Domain\User\Contracts\UserOfficeRepositoryInterface;

class UserOfficeController extends BaseController
{
    protected $repository = null;

    public function __construct(UserOfficeRepositoryInterface $repository)
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
            UserOfficeResource::collection($this->repository->all()),
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
        $userOffice = $this->repository->find($id);
        return $this->HTTPStatus::sendResponse(
            UserOfficeResource::make($userOffice),
            $this->HTTPStatus::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Domain\User\Request\UserOfficeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserOfficeRequest $request)
    {
        $userOffice = $this->repository->create($request->all());
        if(!$userOffice){
            return $this->HTTPStatus::sendError($this->HTTPStatus::HTTP_NO_CONTENT);
        }
        return $this->HTTPStatus::sendResponse(
            UserOfficeResource::make($userOffice),
            $this->HTTPStatus::HTTP_CREATED
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Domain\User\Request\UserOfficeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserOfficeRequest $request, $id)
    {
        $userOffice = $this->repository->find($id);
        if($userOffice->update($request->all())){
            return $this->HTTPStatus::sendResponse(
                UserOfficeResource::make($userOffice),
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
        $userOffice = $this->repository->find($id);
        if($this->repository->delete($id)){
            return $this->HTTPStatus::sendResponse(
                UserOfficeResource::make($userOffice),
                $this->HTTPStatus::HTTP_OK
            );
        }
    }
}
