<?php

namespace App\Interfaces\Http\Controllers\Speciality;

use Illuminate\Http\Request;
use App\Infrastructure\Http\Controllers\BaseController;
use App\Domain\Speciality\Resources\SpecialityResource;
use App\Domain\Speciality\Request\SpecialityRequest;
use App\Domain\Speciality\Contracts\SpecialityRepositoryInterface;

class SpecialityController extends BaseController
{
    protected $repository = null;

    public function __construct(SpecialityRepositoryInterface $repository)
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
            SpecialityResource::collection($this->repository->all()),
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
        $speciality = $this->repository->find($id);
        return $this->HTTPStatus::sendResponse(
            SpecialityResource::make($speciality),
            $this->HTTPStatus::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Domain\Speciality\Request\SpecialityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SpecialityRequest $request)
    {
        $speciality = $this->repository->create($request->all());
        if(!$speciality){
            return $this->HTTPStatus::sendError($this->HTTPStatus::HTTP_NO_CONTENT);
        }
        return $this->HTTPStatus::sendResponse(
            SpecialityResource::make($speciality),
            $this->HTTPStatus::HTTP_CREATED
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Domain\Speciality\Request\SpecialityRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SpecialityRequest $request, $id)
    {
        $speciality = $this->repository->find($id);
        if($speciality->update($request->all())){
            return $this->HTTPStatus::sendResponse(
                SpecialityResource::make($speciality),
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
        $speciality = $this->repository->find($id);
        if($this->repository->delete($id)){
            return $this->HTTPStatus::sendResponse(
                SpecialityResource::make($speciality),
                $this->HTTPStatus::HTTP_OK
            );
        }
    }
}
