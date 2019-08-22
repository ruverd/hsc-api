<?php

namespace App\Interfaces\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Infrastructure\Http\Controllers\BaseController;
use App\Domain\User\Resources\UserApprovalResource;
use App\Domain\User\Request\UserApprovalRequest;
use App\Domain\User\Contracts\UserApprovalRepositoryInterface;

class UserApprovalController extends BaseController
{
    protected $repository = null;

    public function __construct(UserApprovalRepositoryInterface $repository)
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
            UserApprovalResource::collection($this->repository->all()),
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
        $userApproval = $this->repository->find($id);
        return $this->HTTPStatus::sendResponse(
            UserApprovalResource::make($userApproval),
            $this->HTTPStatus::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Domain\User\Request\UserApprovalRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserApprovalRequest $request)
    {
        $userApproval = $this->repository->create($request->all());
        if(!$userApproval){
            return $this->HTTPStatus::sendError($this->HTTPStatus::HTTP_NO_CONTENT);
        }
        return $this->HTTPStatus::sendResponse(
            UserApprovalResource::make($userApproval),
            $this->HTTPStatus::HTTP_CREATED
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Domain\User\Request\UserApprovalRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserApprovalRequest $request, $id)
    {
        $userApproval = $this->repository->find($id);
        if($userApproval->update($request->all())){
            return $this->HTTPStatus::sendResponse(
                UserApprovalResource::make($userApproval),
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
        $userApproval = $this->repository->find($id);
        if($this->repository->delete($id)){
            return $this->HTTPStatus::sendResponse(
                UserApprovalResource::make($userApproval),
                $this->HTTPStatus::HTTP_OK
            );
        }
    }
}
