<?php

namespace App\Models\Staff;

use App\Models\Staff\Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function items() 
    {
        return $this->belongsToMany(Item::class);
    }
}
