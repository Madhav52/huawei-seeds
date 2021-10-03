<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class UserDetail extends Model

{
    protected $fillable = [
        'name', 'email', 'phone', 'gender', 'address', 'university', 'institution', 'files', 'statement', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFilesAttribute($file)
    {
        return env('APP_URL') . '/storage/' . $file;
    }
}
