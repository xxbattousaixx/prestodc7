<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'category_id', 'user_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
        
    }

    public function user()
    {
        return $this->belongsTo(User::class);
        
    }
    
    static public function ToBeRevisionedCount()
    {
        return Article::where('is_accepted', null)->count();
    }
}
