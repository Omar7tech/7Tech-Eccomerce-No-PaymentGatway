<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
   /*  $table->id();
    $table->string('title')->nullable();
    $table->text('image_url');
    $table->string('link_url')->nullable();
    $table->boolean('is_active')->default(true);
    $table->integer('order')->default(0);
    $table->timestamps(); */

    protected $fillable = [
        'title',
        'image_url',
        'link_url',
        'is_active',
        'description',
        'order',
    ];
    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];
    public function getRouteKeyName()
    {
        return 'id';
    }
}
