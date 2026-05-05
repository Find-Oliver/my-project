<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment_type extends Model
{
    protected $table = 'equipment_type';
    protected $fillable = [
        'id',
        'category',
        'sub_category',

    ];
    /** @use HasFactory<\Database\Factories\EquipmentTypeFactory> */
    use HasFactory;

    public function response(){
        return $this->hasMany(Response::class, 'equipment_type_id');
    }

}
