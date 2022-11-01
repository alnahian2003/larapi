<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name',
        'description',
        'price',
    ];

    /**
     * Interact with the product's slug.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            return $product->slug = str()->slug($product->name);
        });

        static::updating(function ($product) {
            return $product->slug = str()->slug($product->name);
        });
    }
}
