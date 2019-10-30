<?php

namespace App\Interfaces\Http\Controllers\Register;

use App\Domain\User\Contracts\UserSpecialityRepositoryInterface;
use App\Domain\User\Contracts\UserFileRepositoryInterface;
use App\Domain\User\Contracts\UserRepositoryInterface;
use App\Domain\User\Resources\UserResource;
use App\Infrastructure\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ValidateController extends BaseController
{
    protected $repository,
              $repositoryUserSpeciality,
              $repositoryUserFile = null;

    public function __construct(
        UserRepositoryInterface $repository,
        UserSpecialityRepositoryInterface $repositoryUserSpeciality,
        UserFileRepositoryInterface $repositoryUserFile
    )
    {
        $this->repository = $repository;
        $this->repositoryUserSpeciality = $repositoryUserSpeciality;
        $this->repositoryUserFile = $repositoryUserFile;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Illuminate\Http\Request;  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = $this->repository->find($id);

        $arrayForm = [
            'validated' => Carbon::today()->toDateString(),
            'user_status_id' => $request->approved ? 3 : 4
        ];

        if($request->comment)
            $arrayForm['comment'] = $request->comment;

        if($user->update($arrayForm)){
            $this->updateFile($id);
            $this->updateSpeciality($id);

            return $this->HTTPStatus::sendResponse(
                UserResource::make($user),
                $this->HTTPStatus::HTTP_ACCEPTED
            );
        }
    }

    /**
     * Update all files not valideted for this user
     *
     * @param  int  $userId
     */
    private function updateFile($userId)
    {
        $files = $this->repositoryUserFile->findWhere([
            'user_id' => $userId,
            'approved' => null
        ]);

        foreach ($files as $file) {
            $this->repositoryUserFile->update(
                [ 'approved' => 1 ],
                $file->id
            );
        }
    }

    /**
     * Update all specialities not valideted for this user
     *
     * @param  int  $userId
     */
    private function updateSpeciality($userId)
    {
        $specialities = $this->repositoryUserSpeciality->findWhere([
            'user_id' => $userId,
            'approved' => null
        ]);

        foreach ($specialities as $speciality) {
            $this->repositoryUserSpeciality->update(
                [ 'approved' => 1 ],
                $speciality->id
            );
        }
    }
}
