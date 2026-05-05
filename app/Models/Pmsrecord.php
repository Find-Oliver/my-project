<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pmsrecord extends Model
{
    use HasFactory;

    protected $connection = 'pms';
    protected $table = 'pms_record';
    protected $fillable = [
        'id',
        'name',
        'division',
        'conducted_by',
        'conforme',
    ];

    public function owner()
    {
        return $this->belongsTo(Staff::class, 'name', 'user_id');
    }

    public function conductedBy()
    {
        return $this->belongsTo(Staff::class, 'conducted_by', 'user_id');
    }

    public function conformes()
    {
        return $this->belongsTo(Staff::class, 'conforme', 'user_id');
    }
}
