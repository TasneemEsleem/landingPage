<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    public function activeStatus(): Attribute
    {
        return new  Attribute(get: fn () => $this->active ? 'Active' : 'In-Active');
        
    }
}
