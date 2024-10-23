<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Minimarket extends Model
{
    public $table = 'minimarkets';

    protected $fillable = [
        'type', 'name', 'price', 'stock'
    ];
}
