<?php

namespace App\Models\Staff;

use App\Models\Staff\Colour;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Size extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function colours()
    {
        return $this->belongsToMany(Colour::class);
    }
}
