<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchModel extends Model
{
    use HasFactory;
    protected $table = 'matches';

    protected $fillable = [
        "competition_id",
        "competition_name",
        "competition_category_code",
        "player_category_code",
        "round_category_id",
        "match_type_category_id",
        "home_first_player_id",
        "home_first_player_name",
        "home_second_player_id",
        "home_second_player_name",
        "home_final_score",
        "away_first_player_id",
        "away_first_player_name",
        "away_second_player_id",
        "away_second_player_name",
        "away_final_score",
        "winner",
        "date",
        "user_id",
        "status",
    ];

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }

    public function match_detail()
    {
        return $this->hasOne(MatchDetail::class, 'match_id');
    }

    public function match_type()
    {
        return $this->belongsTo(Category::class, 'match_type_category_id', 'id');
    }

    public function round_category()
    {
        return $this->belongsTo(Category::class, 'round_category_id', 'id');
    }

    public function player_category()
    {
        return $this->belongsTo(Category::class, 'player_category_code', 'code');
    }

    public function home_first_player()
    {
        return $this->belongsTo(Player::class, 'home_first_player_id', 'id');
    }

    public function home_second_player()
    {
        return $this->belongsTo(Player::class, 'home_second_player_id', 'id');
    }

    public function away_first_player()
    {
        return $this->belongsTo(Player::class, 'away_first_player_id', 'id');
    }

    public function away_second_player()
    {
        return $this->belongsTo(Player::class, 'away_second_player_id', 'id');
    }
}
