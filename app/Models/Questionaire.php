<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Finder\Iterator\SortableIterator;

class Questionaire extends Model
{

protected $table = 'questionaire';
    protected $fillable = [
            'id',
            'category_id',
            'question',
            'is_required',
            'input_type',
            'sorting',
    ];
    /** @use HasFactory<\Database\Factories\QuestionaireFactory> */
    use HasFactory;

    public function category(){
        return $this->belongsTo(category::class, 'category_id');
    }
}
