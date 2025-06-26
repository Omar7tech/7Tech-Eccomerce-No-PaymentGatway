<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    use HasSlug;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'brief_description',
        'weight',
        'width',
        'height',
        'depth',
        'price',
        'sale_price',
        'stock',
        'sort',
        'sku',
        'barcode',
        'is_active',
        'is_featured',
        'is_new',
        'is_on_sale',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'is_new' => 'boolean',
        'is_on_sale' => 'boolean',
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'weight' => 'decimal:2',
        'width' => 'decimal:2',
        'height' => 'decimal:2',
        'depth' => 'decimal:2',
        'stock' => 'integer',
        'sort' => 'integer',
    ];


    protected $attributes = [
        'stock' => 0,
        'is_active' => true,
        'is_featured' => false,
        'is_new' => false,
        'is_on_sale' => false,
    ];




    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    // In App\Models\Product.php
    public function firstSortedImage()
    {
        return $this->hasOne(ProductImage::class)->orderBy('sort');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function wishlists()
    {
        return $this->belongsToMany(User::class, 'wishlists')
            ->withTimestamps();
    }

}





