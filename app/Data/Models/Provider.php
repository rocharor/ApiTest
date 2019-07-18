<?php

namespace App\Data\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provider extends Authenticatable
{
    use SoftDeletes;

    protected $table = 'providers';

    protected $fillable = [
        'user_id', 'name', 'email', 'monthly_payment', 'status'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
