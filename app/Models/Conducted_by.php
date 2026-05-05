<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Staff;

class Conducted_by extends Model
{
    use HasFactory;

    protected $table = 'conducted_by';
    protected $fillable = [
        'user_id',
    ];


public function staff()
{
    return $this->belongsTo(Staff::class, 'user_id', 'user_id');
}

    /** @use HasFactory<\Database\Factories\Conducted_byFactory> */

}
