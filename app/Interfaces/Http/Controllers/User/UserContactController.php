<?php

namespace App\Interfaces\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Infrastructure\Http\Controllers\BaseController;
use App\Domain\User\Resources\UserContactResource;
use App\Domain\User\Request\UserContactRequest;
use App\Domain\User\Contracts\UserContactRepositoryInterface;

class UserContactController extends BaseController
{
    protected $repository = null;

    public function __construct(UserContactRepositoryInterface $repository)
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
            UserContactResource::collection($this->repository->all()),
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
        $userContact = $this->repository->find($id);
        return $this->HTTPStatus::sendResponse(
            UserContactResource::make($userContact),
            $this->HTTPStatus::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Domain\User\Request\UserContactRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserContactRequest $request)
    {
        $userContact = $this->repository->create($request->all());
        if(!$userContact){
            return $this->HTTPStatus::sendError($this->HTTPStatus::HTTP_NO_CONTENT);
        }
        return $this->HTTPStatus::sendResponse(
            UserContactResource::make($userContact),
            $this->HTTPStatus::HTTP_CREATED
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Domain\User\Request\UserContactRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserContactRequest $request, $id)
    {
        $userContact = $this->repository->find($id);
        if($userContact->update($request->all())){
            return $this->HTTPStatus::sendResponse(
                UserContactResource::make($userContact),
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
        $userContact = $this->repository->find($id);
        if($this->repository->delete($id)){
            return $this->HTTPStatus::sendResponse(
                UserContactResource::make($userContact),
                $this->HTTPStatus::HTTP_OK
            );
        }
    }
}
