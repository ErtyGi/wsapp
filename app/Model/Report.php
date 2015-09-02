<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{

    protected $fillable = ['website_id', 'user_id'];

    /**
     * Reports is owned by a user.
     *
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo('App\User');
    }

}
