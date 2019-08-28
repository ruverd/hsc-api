<?php

namespace App\Interfaces\Http\Controllers\Register;

use Illuminate\Http\Request;
use App\Infrastructure\Http\Controllers\BaseController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Domain\User\Resources\UserSpecialityResource;
use App\Domain\User\Request\UserSpecialityRequest;
use App\Domain\User\Contracts\UserSpecialityRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class SpecialityController extends BaseController
{
    use AuthenticatesUsers;

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
     * Display a listing of the resource.
     *
     * @return Resource
     */
    public function getSpecialitiesByUser($userId)
    {
        $specialities = $this->repository->findByField('user_id',$userId);

        return $this->HTTPStatus::sendResponse(
            UserSpecialityResource::collection($specialities),
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
        $speciality = $this->repository->findByField('user_id',$id);
        return $this->HTTPStatus::sendResponse(
            UserSpecialityResource::make($speciality),
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
        $file = Storage::put('register/1/', $request->file);
        $filename = basename($file);

        $speciality = $this->repository->create([
            'user_id' => $request->user_id,
            'speciality_id' => $request->speciality_id,
            'file' => $filename
        ]);

        return $this->HTTPStatus::sendResponse(
            UserSpecialityResource::make($speciality),
            $this->HTTPStatus::HTTP_CREATED
        );
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
