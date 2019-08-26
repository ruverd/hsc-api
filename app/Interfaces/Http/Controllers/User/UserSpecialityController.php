<?php

namespace App\Interfaces\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Infrastructure\Http\Controllers\BaseController;
use App\Domain\User\Resources\UserSpecialityResource;
use App\Domain\User\Request\UserSpecialityRequest;
use App\Domain\User\Contracts\UserSpecialityRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class UserSpecialityController extends BaseController
{
    protected $repository = null;

    public function __construct(UserSpecialityRepositoryInterface $repository)
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
            UserSpecialityResource::collection($this->repository->all()),
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
        $userSpeciality = $this->repository->find($id);
        return $this->HTTPStatus::sendResponse(
            UserSpecialityResource::make($userSpeciality),
            $this->HTTPStatus::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->HTTPStatus::sendResponse(
                'asdasdas',
                $this->HTTPStatus::HTTP_CREATED
            );

        // if ($request->hasFile('file')) {
        //     $path = $request->file('file')->store('images');
        //     return response()->json([
        //         'message' => 'Upload success.',
        //         'path' => $path,
        //         'status' => 200
        //     ], 200);
        // }
        //Storage::put('register/'.$request->userId.'/', $request->file);

        // $userSpeciality = $this->repository->create($request->all());
        // if(!$userSpeciality){
        //     return $this->HTTPStatus::sendError($this->HTTPStatus::HTTP_NO_CONTENT);
        // }

        // return $this->HTTPStatus::sendResponse(
        //     UserSpecialityResource::make($userSpeciality),
        //     $this->HTTPStatus::HTTP_CREATED
        // );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Domain\User\Request\UserSpecialityRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserSpecialityRequest $request, $id)
    {
        $userSpeciality = $this->repository->find($id);
        if($userSpeciality->update($request->all())){
            return $this->HTTPStatus::sendResponse(
                UserSpecialityResource::make($userSpeciality),
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
        $userSpeciality = $this->repository->find($id);
        if($this->repository->delete($id)){
            return $this->HTTPStatus::sendResponse(
                UserSpecialityResource::make($userSpeciality),
                $this->HTTPStatus::HTTP_OK
            );
        }
    }
}
