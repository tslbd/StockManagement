<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;
    public const PLACEHOLDER_IMAGE_PATH = 'image/placeholder.jpeg';
    protected $fillable = [
        'title',
        'description',
        'price',
        'photo',
    ];
//    protected $guarded = [];
    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
