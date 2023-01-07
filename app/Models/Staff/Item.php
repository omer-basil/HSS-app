<?php

namespace App\Models\Staff;

use App\Models\Staff\Tag;
use App\Models\Staff\Size;
use App\Models\Staff\Colour;
use App\Models\Staff\Category;
use App\Models\Customer\Rating;
use App\Models\Customer\Review;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $cast = [
        'description' => 'text',
        'model' => 'dateTiem',
    ];

    public function colours()
    {
        return $this->belongsToMany(Colour::class, 'colour_item')->withPivot('colour_id', 'item_id');
    }
    
    public function sizes()
    {
        return $this->hasManyThrough(Size::class, Colour::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
    public function averageRating()
    {
        return $this->ratings()->avg('rating');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
