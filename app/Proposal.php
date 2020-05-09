<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    protected $fillable = [
        'directory', 'category', 'description',
    ];

    protected $casts = [
        'event_date' => 'datetime',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
