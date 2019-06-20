<?php

namespace App\Interfaces\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Infrastructure\Http\Controllers\BaseController;
use App\Domain\User\Resources\UserBackgroundResource;
use App\Domain\User\Request\UserBackgroundRequest;
use App\Domain\User\Contracts\UserBackgroundRepositoryInterface;

class UserBackgroundController extends BaseController
{
    protected $repository = null;

    public function __construct(UserBackgroundRepositoryInterface $repository)
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
            UserBackgroundResource::collection($this->repository->all()),
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
        $userBackground = $this->repository->find($id);
        return $this->HTTPStatus::sendResponse(
            UserBackgroundResource::make($userBackground),
            $this->HTTPStatus::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Domain\User\Request\UserBackgroundRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserBackgroundRequest $request)
    {
        $userBackground = $this->repository->create($request->all());
        if(!$userBackground){
            return $this->HTTPStatus::sendError($this->HTTPStatus::HTTP_NO_CONTENT);
        }
        return $this->HTTPStatus::sendResponse(
            UserBackgroundResource::make($userBackground),
            $this->HTTPStatus::HTTP_CREATED
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Domain\User\Request\UserBackgroundRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserBackgroundRequest $request, $id)
    {
        $userBackground = $this->repository->find($id);
        if($userBackground->update($request->all())){
            return $this->HTTPStatus::sendResponse(
                UserBackgroundResource::make($userBackground),
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
        $userBackground = $this->repository->find($id);
        if($this->repository->delete($id)){
            return $this->HTTPStatus::sendResponse(
                UserBackgroundResource::make($userBackground),
                $this->HTTPStatus::HTTP_OK
            );
        }
    }
}
