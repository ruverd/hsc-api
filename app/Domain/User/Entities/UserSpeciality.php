<?php
namespace App\Domain\User\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Domain\User\Entities\User;
use App\Domain\Speciality\Entities\Speciality;

class UserSpeciality extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'user_id',
    'speciality_id',
    'filename',
    'approved',
    'comment'
  ];

  /**
   * Relation with user
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function user()
  {
    return $this->belongsTo(User::class);
  }

  /**
   * Relation with speciality
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function speciality()
  {
    return $this->belongsTo(Speciality::class);
  }
}
