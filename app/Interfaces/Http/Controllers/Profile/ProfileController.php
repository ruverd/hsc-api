<?php

namespace App\Interfaces\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Infrastructure\Http\Controllers\BaseController;
use App\Domain\Profile\Resources\ProfileResource;
use App\Domain\Profile\Request\ProfileRequest;
use App\Domain\Profile\Contracts\ProfileRepositoryInterface;

class ProfileController extends BaseController
{
    protected $repository = null;

    public function __construct(ProfileRepositoryInterface $repository)
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
            ProfileResource::collection($this->repository->all()),
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
        $profile = $this->repository->find($id);
        return $this->HTTPStatus::sendResponse(
            ProfileResource::make($profile),
            $this->HTTPStatus::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Domain\Profile\Request\ProfileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfileRequest $request)
    {
        $profile = $this->repository->create($request->all());
        if(!$profile){
            return $this->HTTPStatus::sendError($this->HTTPStatus::HTTP_NO_CONTENT);
        }
        return $this->HTTPStatus::sendResponse(
            ProfileResource::make($profile),
            $this->HTTPStatus::HTTP_CREATED
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Domain\Profile\Request\ProfileRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request, $id)
    {
        $profile = $this->repository->find($id);
        if($profile->update($request->all())){
            return $this->HTTPStatus::sendResponse(
                ProfileResource::make($profile),
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
        $profile = $this->repository->find($id);
        if($this->repository->delete($id)){
            return $this->HTTPStatus::sendResponse(
                ProfileResource::make($profile),
                $this->HTTPStatus::HTTP_OK
            );
        }
    }
}
