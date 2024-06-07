<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'price',
        'photo',
    ];

        public function users(): BelongsToMany
        {
            return $this->belongsToMany(User::class, 'product_users');
        }
}
