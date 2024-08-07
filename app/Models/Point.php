<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Point extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function match()
    {
        return $this->belongsTo(MatchModel::class);
    }

    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}
