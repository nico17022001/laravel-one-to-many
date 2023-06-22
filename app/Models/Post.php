<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'date',
        'image_path',
        'image_orginal_name'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public static function generateSlug($str){
        $slug = Str::slug($str, '-');
        $original_slug = $slug;

        $slug_exists = Post::where('slug', $slug)->first();
        $c = 1;
        while($slug_exists){
            $slug = $original_slug . '-' . $c;
            $slug_exists = Post::where('slug', $slug)->first();
            $c++;
        }
        return $slug;
    }
}
