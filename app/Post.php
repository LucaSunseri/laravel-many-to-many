<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    protected $fillable = [
        'title',
        'content',
        'slug',
        'category_id'
    ];


    static function gerateSlug($string)
    {

        $slug = Str::slug($string);
        $original_slug = $slug;
        $count = 1;

        while (static::whereSlug($slug)->exists()) {

            $slug = $original_slug . '-' . $count++;
        }

        return $slug;
    }
}
