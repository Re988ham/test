<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'group_id',
        'owner_id',
        'status',
        'updated_at',
    ];

    // The attributes that should be cast to native types
    protected $casts = [
        'updated_at' => 'datetime'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }
}
