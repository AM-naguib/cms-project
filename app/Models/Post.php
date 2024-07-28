<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function keywords()
    {
        return $this->belongsToMany(Keyword::class);
    }
    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function quality()
    {
        return $this->belongsTo(Quality::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function main_name()
    {
        return $this->belongsTo(MainName::class);
    }
    public function year()
    {
        return $this->belongsTo(Year::class);
    }


    public function image(){
        if($this->image_url){
            return env('APP_URL')."/storage/".$this->image_url;
        }

        return "https://via.placeholder.com/150";
    }
}
