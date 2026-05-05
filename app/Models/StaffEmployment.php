<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffEmployment extends Model
{
    use HasFactory;

    protected $connection = 'pamana'; // 🔥 IMPORTANT
    protected $table = 'staff_employment';
}

