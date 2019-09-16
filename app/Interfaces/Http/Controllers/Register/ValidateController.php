<?php

namespace App\Interfaces\Http\Controllers\Register;

use App\Domain\User\Contracts\UserRepositoryInterface;
use App\Domain\User\Resources\UserResource;
use App\Infrastructure\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ValidateController extends BaseController
{
    protected $repository = null;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
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
        $dateToday = Carbon::today()->toDateString();
        $status = $request->approved ? 3 : 4;
        $arrayForm = [ 'validated' => $dateToday, 'user_status_id' => $status];

        if($request->comment)
            $arrayForm['comment'] = $request->comment;

        if($user->update($arrayForm)){
            return $this->HTTPStatus::sendResponse(
                UserResource::make($user),
                $this->HTTPStatus::HTTP_ACCEPTED
            );
        }
    }
}
