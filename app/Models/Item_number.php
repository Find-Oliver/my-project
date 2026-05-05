<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item_number extends Model
{
    use HasFactory;

    protected $connection = 'pamana'; // 🔥 IMPORTANT
    protected $table = 'item_number';
}

