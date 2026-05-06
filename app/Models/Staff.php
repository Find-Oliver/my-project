<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $connection = 'pamana';
    protected $table = 'staffs';

    // ✅ HIDE SENSITIVE DATA
    protected $hidden = [
        'email',
        'secondary_email',
        'birthdate',
        'cellphone_number',
        'telephone_number',
        'emergency_name',
        'emergency_address',
        'emergency_contact',
    ];

    // 🔥 Full Name Accessor
    public function getFullnameAttribute()
    {
        $first = strtoupper($this->first_name);
        $middle = strtoupper($this->middle_initial);
        $last = strtoupper($this->last_name);

        // If middle name exists, include it
        if (!empty($middle)) {
            return "{$last}, {$first} {$middle}. ";
        }

        // If no middle name
        return "{$last}, {$first}";
    }
}
