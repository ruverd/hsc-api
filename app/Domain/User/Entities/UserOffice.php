<?php

namespace App\Domain\User\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Domain\User\Entities\User;

class UserOffice extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'street',
        'number',
        'neighborhood',
        'city',
        'state',
        'additional',
        'zipcode',
        'phone',
        'extension',
        'email',
        'supervisor',
        'crm'
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
