<?php

namespace App\Models\Staff;

use App\Models\Staff\Taggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function taggable()
  {
    return $this->morphedByMany(Taggable::class, 'taggable');
  }
}
