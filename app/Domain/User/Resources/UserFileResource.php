<?php

namespace App\Domain\User\Resources;

use App\Infrastructure\Http\Resources\BaseResource;
use App\Domain\User\Resources\UserResource;
use App\Domain\File\Resources\FileResource;

class UserFileResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'user' => UserResource::make($this->user),
            'file_id' => $this->file_id,
            'file' => FileResource::make($this->file),
            'filename' => $this->filename,
            'approved' => $this->approved,
            'status' => $this->getStatusLabel($this->approved),
            'comment' => $this->comment,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }

    private function getStatusLabel($approved)
    {
        if ($approved === 1)
            return "Aprovado";
        else if ($approved === 0)
            return "Negado";

        return "Processando";
    }
}
