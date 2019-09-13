<?php

namespace App\Interfaces\Http\Controllers\Register;

use App\Domain\User\Contracts\UserFileRepositoryInterface;
use App\Domain\User\Resources\UserFileResource;
use App\Infrastructure\Http\Controllers\BaseController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends BaseController
{
    use AuthenticatesUsers;

    protected $repository = null;

    public function __construct(UserFileRepositoryInterface $repository)
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
            UserFileResource::collection($this->repository->all()),
            $this->HTTPStatus::HTTP_OK
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return Resource
     */
    public function getFilesByUser($userId)
    {
        $files = $this->repository->findByField('user_id', $userId);

        return $this->HTTPStatus::sendResponse(
            UserFileResource::collection($files),
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
        $file = $this->repository->findByField('user_id', $id);

        return $this->HTTPStatus::sendResponse(
            UserFileResource::make($file),
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
        $file = Storage::put('register/' . $request->user_id . '/', $request->file);
        $filename = basename($file);

        $file = $this->repository->create([
            'user_id' => $request->user_id,
            'file_id' => $request->file_id,
            'filename' => $filename,
        ]);

        return $this->HTTPStatus::sendResponse(
            UserFileResource::make($file),
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
        $userFile = $this->repository->find($id);

        $fileName = 'register/' . $userFile->user_id . '/' . $userFile->filename;
        Storage::delete($fileName);

        if ($this->repository->delete($id)) {
            return $this->HTTPStatus::sendResponse(
                UserFileResource::make($userFile),
                $this->HTTPStatus::HTTP_OK
            );
        }
    }

    /**
     * Return file base64
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function download($id)
    {
        $userFile = $this->repository->find($id);

        $fileName = 'register/' . $userFile->user_id . '/' . $userFile->filename;
        $path_parts = pathinfo($fileName);
        $contents = Storage::get($fileName);
        $base64 = base64_encode($contents);

        return response()->json(
            [
                'fileBase64' => $base64,
                'extension' => $path_parts['extension'],
            ], $this->HTTPStatus::HTTP_OK
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
        $userFile = $this->repository->find($id);
        if($userFile->update($request->all())){
            return $this->HTTPStatus::sendResponse(
                UserFileResource::make($userFile),
                $this->HTTPStatus::HTTP_ACCEPTED
            );
        }
    }
}
