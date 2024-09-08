<?php

namespace App\Models;

use Hashids\Hashids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'author',
        'content',
        'validated',
        'views',
        'daily_count',
    ];

    protected $attributes = [
        'validated' => false,
        'views' => 0,
        'daily_count' => 0,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function hashFromId(int $id): string
    {
        return (new Hashids('', 5))->encode($id);
    }

    public function getHashAttribute(): string
    {
        return static::hashFromId($this->id);
    }

    public static function idFromHash(string $hash): int
    {
        return (new Hashids('', 5))->decode($hash)[0];
    }
}
