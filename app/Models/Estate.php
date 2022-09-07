<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estate extends Model
{
    use HasFactory;
    protected $visible = ['title', 'contact', 'phone', 'embed', 'mapurl', 'price', 'description', 'image', 'longitude', 'latitude', 'status', 'country', 'region', 'constituency', 'county', 'district', 'postcode'];
}
