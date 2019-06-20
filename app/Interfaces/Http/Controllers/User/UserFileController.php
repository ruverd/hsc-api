<?php

namespace App\Interfaces\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Infrastructure\Http\Controllers\BaseController;
use App\Domain\User\Resources\UserFileResource;
use App\Domain\User\Request\UserFileRequest;
use App\Domain\User\Contracts\UserFileRepositoryInterface;

class UserFileController extends BaseController
{
    protected $repository = null;

    public function __construct(UserFileRepositoryInterface $repository)
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
            UserFileResource::collection($this->repository->all()),
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
        $userFile = $this->repository->find($id);
        return $this->HTTPStatus::sendResponse(
            UserFileResource::make($userFile),
            $this->HTTPStatus::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Domain\User\Request\UserFileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserFileRequest $request)
    {
        $userFile = $this->repository->create($request->all());
        if(!$userFile){
            return $this->HTTPStatus::sendError($this->HTTPStatus::HTTP_NO_CONTENT);
        }
        return $this->HTTPStatus::sendResponse(
            UserFileResource::make($userFile),
            $this->HTTPStatus::HTTP_CREATED
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Domain\User\Request\UserFileRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserFileRequest $request, $id)
    {
        $userFile = $this->repository->find($id);
        if($userFile->update($request->all())){
            return $this->HTTPStatus::sendResponse(
                UserFileResource::make($userFile),
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
        $userFile = $this->repository->find($id);
        if($this->repository->delete($id)){
            return $this->HTTPStatus::sendResponse(
                UserFileResource::make($userFile),
                $this->HTTPStatus::HTTP_OK
            );
        }
    }
}
