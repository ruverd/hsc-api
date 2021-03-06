<?php

namespace App\Interfaces\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Infrastructure\Http\Controllers\BaseController;
use App\Domain\User\Resources\UserDocumentResource;
use App\Domain\User\Request\UserDocumentRequest;
use App\Domain\User\Contracts\UserDocumentRepositoryInterface;

class UserDocumentController extends BaseController
{
    protected $repository = null;

    public function __construct(UserDocumentRepositoryInterface $repository)
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
            UserDocumentResource::collection($this->repository->all()),
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
        $userDocument = $this->repository->find($id);
        return $this->HTTPStatus::sendResponse(
            UserDocumentResource::make($userDocument),
            $this->HTTPStatus::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Domain\User\Request\UserDocumentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserDocumentRequest $request)
    {
        $userDocument = $this->repository->create($request->all());
        if(!$userDocument){
            return $this->HTTPStatus::sendError($this->HTTPStatus::HTTP_NO_CONTENT);
        }
        return $this->HTTPStatus::sendResponse(
            UserDocumentResource::make($userDocument),
            $this->HTTPStatus::HTTP_CREATED
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Domain\User\Request\UserDocumentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserDocumentRequest $request, $id)
    {
        $userDocument = $this->repository->find($id);
        if($userDocument->update($request->all())){
            return $this->HTTPStatus::sendResponse(
                UserDocumentResource::make($userDocument),
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
        $userDocument = $this->repository->find($id);
        if($this->repository->delete($id)){
            return $this->HTTPStatus::sendResponse(
                UserDocumentResource::make($userDocument),
                $this->HTTPStatus::HTTP_OK
            );
        }
    }
}
