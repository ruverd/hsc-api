<?php

namespace App\Interfaces\Http\Controllers\Register;

use Illuminate\Http\Request;
use App\Infrastructure\Http\Controllers\BaseController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Domain\User\Resources\UserContactResource;
use App\Domain\User\Request\UserContactRequest;
use App\Domain\User\Contracts\UserContactRepositoryInterface;

class ContactController extends BaseController
{
    use AuthenticatesUsers;

    protected $repository = null;

    public function __construct(UserContactRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = $this->repository->findByField('user_id',$id);
        return $this->HTTPStatus::sendResponse(
            UserContactResource::make($contact),
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
        $contact = $this->repository->create($request->all());

        if(!$contact){
            return $this->HTTPStatus::sendError($this->HTTPStatus::HTTP_NO_CONTENT);
        }
        return $this->HTTPStatus::sendResponse(
            UserContactResource::make($contact),
            $this->HTTPStatus::HTTP_CREATED
        );
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
        $contact = $this->repository->find($id);

        if($contact->update($request->all())){
            return $this->HTTPStatus::sendResponse(
                UserContactResource::make($contact),
                $this->HTTPStatus::HTTP_ACCEPTED
            );
        }
    }
}
