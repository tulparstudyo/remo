<?php

namespace App\Models;

use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $visible = ['firstname', 'lastname', 'title', 'firstname', 'lastname', 'email', 'phone', 'description', 'image'];
}
