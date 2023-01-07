<?php

namespace App\Models\Customer;

use App\Models\Staff\Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rating extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Item()
    {
        return $this->belongsTo(Item::class);
    }
}
