<?php

namespace App\Domain\User\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Domain\User\Entities\User;

class UserContact extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'street_personal',
        'number_personal',
        'neighborhood_personal',
        'city_personal',
        'state_personal',
        'additional_personal',
        'zipcode_personal',
        'phone_personal',
        'street_business',
        'number_business',
        'neighborhood_business',
        'city_business',
        'state_business',
        'additional_business',
        'zipcode_business',
        'phone_business'
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
