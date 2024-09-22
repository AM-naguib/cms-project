<?php

namespace App\Models;

use DateInterval;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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


    public function showKeywordsInsinglePost(){
        return $this->keywords->pluck('name')->implode(', ');
    }
    public function getFormattedDurationAttribute()
    {
        $minutes = $this->duration; // Assuming 'duration' is stored in minutes
        $interval = new DateInterval('PT' . $minutes . 'M');

        return $interval->format('PT%HH%IM'); // Formatting the output
    }
}
