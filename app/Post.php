<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
       protected $fillable = ['title', 'slug', 'body', 'category_id', 'thumbnail'];
       protected $with = ['category', 'tags', 'author'];

       public function getTakeImageAttribute()
       {
              return "/storage/" . $this->thumbnail;
       }
       public function category()
       {
              return $this->belongsTo(Category::class);
       }

       public function tags()
       {
              return $this->belongsToMany(Tag::class);
       }

       public function author()
       {
              return $this->belongsto(User::class, 'user_id');
       }
}
