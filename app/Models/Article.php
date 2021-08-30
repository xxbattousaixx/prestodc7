<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Article extends Model
{
    use HasFactory;

    use Searchable;

    protected $fillable = ['title', 'body', 'category_id', 'user_id'];

    public function toSearchableArray(){

        $array = [
            "id" => $this->id,
            "title" => $this->title,
            "body"=> $this->body,
        ];
        return $array;
        
    }
    public function images(){
        return $this->hasMany(ArticleImage::class);
    }
   
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
