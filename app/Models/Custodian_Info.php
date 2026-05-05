<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Custodian_Info extends Model
{
    protected $table = 'custodian_info';

    protected $fillable = [
        'id',
        'user_id',
        'brand',
        'model',
        'type',
        'serial_number',
        'mac_address',
        'ip_address',

    ];
    use HasFactory;
    public function Response()
    {
        return $this->belongsTo(Response::class, 'user_id');
    }

}
