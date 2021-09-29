<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class UserDetail extends Model

{
    protected $fillable = [
        'name', 'email', 'phone', 'gender', 'address', 'university', 'institution', 'files', 'statement'
    ];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
    
}
