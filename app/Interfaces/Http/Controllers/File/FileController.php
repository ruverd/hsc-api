<?php

namespace App\Interfaces\Http\Controllers\File;

use Illuminate\Http\Request;
use App\Infrastructure\Http\Controllers\BaseController;
use App\Domain\File\Resources\FileResource;
use App\Domain\File\Request\FileRequest;
use App\Domain\File\Contracts\FileRepositoryInterface;

class FileController extends BaseController
{
    protected $repository = null;

    public function __construct(FileRepositoryInterface $repository)
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
            FileResource::collection($this->repository->all()),
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
        $file = $this->repository->find($id);

        return $this->HTTPStatus::sendResponse(
            FileResource::make($file),
            $this->HTTPStatus::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Domain\File\Request\FileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FileRequest $request)
    {
        $file = $this->repository->create($request->all());

        if(!$file){
            return $this->HTTPStatus::sendError($this->HTTPStatus::HTTP_NO_CONTENT);
        }

        return $this->HTTPStatus::sendResponse(
            FileResource::make($file),
            $this->HTTPStatus::HTTP_CREATED
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Domain\File\Request\FileRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FileRequest $request, $id)
    {
        $file = $this->repository->find($id);

        if($file->update($request->all())){
            return $this->HTTPStatus::sendResponse(
                FileResource::make($file),
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
        $file = $this->repository->find($id);

        if($this->repository->delete($id)){
            return $this->HTTPStatus::sendResponse(
                FileResource::make($file),
                $this->HTTPStatus::HTTP_OK
            );
        }
    }
}
