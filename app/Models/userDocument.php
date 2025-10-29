<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class userDocument extends Model
{
    protected $table = 'user_documents';
    protected $primaryKey = 'id';
    protected $timestamp = true;

    protected $fillable = [
        'user_id',
        'file_path',
        'file_name',
        'file_type',
    ];
    function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
