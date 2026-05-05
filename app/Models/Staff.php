<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $connection = 'pamana';
    protected $table = 'staffs';

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
