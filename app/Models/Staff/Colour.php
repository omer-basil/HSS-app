<?php

namespace App\Models\Staff;

use App\Models\Staff\Item;
use App\Models\Staff\Size;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Colour extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function items()
    {
        return $this->belongsToMany(Item::class)->withPivot('colour_id', 'item_id');
    }

    public function sizes()
    {
        return $this->hasMany(Size::class);
    }
}
