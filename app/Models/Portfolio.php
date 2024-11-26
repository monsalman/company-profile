<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Portfolio extends Model
{
    use HasFactory;

    protected $table = 'portfolios';

    protected $fillable = [
        'title',
        'description',
        'image',
        'slug'
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($portfolio) {
            $portfolio->slug = Str::slug($portfolio->title);
        });
        
        static::updating(function ($portfolio) {
            if ($portfolio->isDirty('title')) {
                $portfolio->slug = Str::slug($portfolio->title);
            }
        });
    }

    public function deleteImage()
    {
        if ($this->image && file_exists(storage_path('app/public/' . $this->image))) {
            unlink(storage_path('app/public/' . $this->image));
        }
    }
}