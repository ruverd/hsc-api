<?php

namespace App\Interfaces\Http\Controllers\Register;

use Illuminate\Http\Request;
use App\Infrastructure\Http\Controllers\BaseController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Domain\User\Resources\UserDocumentResource;
use App\Domain\User\Request\UserDocumentRequest;
use App\Domain\User\Contracts\UserDocumentRepositoryInterface;

class DocumentController extends BaseController
{
    use AuthenticatesUsers;

    protected $repository = null;

    public function __construct(UserDocumentRepositoryInterface $repository)
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
        $document = $this->repository->findByField('user_id',$id);
        return $this->HTTPStatus::sendResponse(
            UserDocumentResource::make($document),
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
        $document = $this->repository->create($request->all());
        if(!$document){
            return $this->HTTPStatus::sendError($this->HTTPStatus::HTTP_NO_CONTENT);
        }
        return $this->HTTPStatus::sendResponse(
            UserDocumentResource::make($document),
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
        $document = $this->repository->find($id);
        if($document->update($request->all())){
            return $this->HTTPStatus::sendResponse(
                UserDocumentResource::make($document),
                $this->HTTPStatus::HTTP_ACCEPTED
            );
        }
    }
}
