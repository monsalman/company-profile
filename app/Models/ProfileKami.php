<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileKami extends Model
{
    protected $table = 'profilekami'; // menentukan nama tabel
    protected $fillable = ['title', 'description_1', 'description_2'];
} 