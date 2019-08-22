<?php

namespace App\Domain\User\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Domain\User\Entities\User;

class UserDocument extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'cpf',
        'rg',
        'rg_emitter',
        'crm',
        'crm_emitter',
        'date_crm'
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
