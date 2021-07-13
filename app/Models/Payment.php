<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'payment',
        'status',
        'due_date',
        'user_id'
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

}
