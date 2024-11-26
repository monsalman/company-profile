<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $table = 'portfolios';

    protected $fillable = [
        'title',
        'description',
        'image',
    ];

    public function deleteImage()
    {
        if ($this->image && file_exists(storage_path('app/public/' . $this->image))) {
            unlink(storage_path('app/public/' . $this->image));
        }
    }
}