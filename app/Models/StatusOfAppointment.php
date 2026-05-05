<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusOfAppointment extends Model
{
    use HasFactory;

    protected $connection = 'pamana'; // 🔥 IMPORTANT
    protected $table = 'status_of_appointment';
}

