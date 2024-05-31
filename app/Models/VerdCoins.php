<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerdCoins extends Model
{
    protected $table = 'verdcoins';
    use HasFactory;

    public static function GetVerdCoins()
    {
        return self::all();
    }

}
