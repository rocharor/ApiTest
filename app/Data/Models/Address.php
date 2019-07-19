<?php

namespace App\Data\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address';

    protected $fillable = [
        'user_id', 'cep', 'address'
    ];

    protected $hidden = [
        'created_at', 'updated_at'];
}
