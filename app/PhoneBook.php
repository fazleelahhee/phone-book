<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhoneBook extends Model
{
    /**
     * Only user_id, name, telephone and mobile is allowed
     *
     * @var array
     */
    protected $fillable = ['user_id', 'name', 'telephone', 'mobile'];

    /**
     * Will return user details.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
