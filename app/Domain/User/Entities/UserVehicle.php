<?php

namespace App\Domain\User\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Domain\User\Entities\User;

class UserVehicle extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'brand',
        'model',
        'year',
        'color',
        'renavam',
        'tag'
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
}
