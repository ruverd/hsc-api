<?php

namespace App\Domain\User\Resources;

use App\Infrastructure\Http\Resources\BaseResource;
use App\Domain\User\Resources\UserResource;
use App\Domain\Speciality\Resources\SpecialityResource;

class UserSpecialityResource extends BaseResource
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
      'speciality_id' => $this->speciality_id,
      'speciality' => SpecialityResource::make($this->speciality),
      'file' => $this->file,
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
