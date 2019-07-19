<?php

namespace App\Data\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';

    protected $fillable = [
        'user_id', 'phone'
    ];

    protected $hidden = [
        'created_at', 'updated_at'];
}
