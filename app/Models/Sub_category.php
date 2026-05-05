<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub_category extends Model
{

protected $table = 'sub_category';
    protected $fillable = [
        'id',
        'category_id',
        'description',
    ];
    /** @use HasFactory<\Database\Factories\SubCategoryFactory> */
    use HasFactory;

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }


}
