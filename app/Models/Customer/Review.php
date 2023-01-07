<?php

namespace App\Models\Customer;

use App\Models\Customer\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function customers()
    {
        return $this->BelongsTo(Customer::class);
    }
    public function items()
    {
        return $this->belongsTo(Item::class);
    }
}
