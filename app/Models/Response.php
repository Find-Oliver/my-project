<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{

protected $table = 'response';
    protected $fillable = [
        'id',
        'question_id',
        'status',
        'remarks',
        'response_array',
    ];
    /** @use HasFactory<\Database\Factories\ResponseFactory> */
    use HasFactory;

    public function custodianinfo()
    {
        return $this->belongsTo(Custodian_Info::class, 'user_id');
    }

    // public function response()
    // {
    //     return $this->hasMany(Questionaire::class)->orderBy('sorting', 'asc');
    // }

}
