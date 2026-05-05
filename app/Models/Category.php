<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

protected $table = 'category';
    protected $fillable = [
        'id',
        'description',
    ], $with=['questionaire'];
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    public function questionaire()
    {
        return $this->hasMany(Questionaire::class)->orderBy('sorting', 'asc');
    }
    public function sub_category()
{
    return $this->hasMany(Sub_Category::class);

}
}

