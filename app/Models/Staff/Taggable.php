<?php

namespace App\Models\Staff;

use App\Models\Staff\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Taggable extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
