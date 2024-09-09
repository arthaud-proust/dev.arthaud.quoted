<?php

namespace App\Models;

use Hashids\Hashids;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\URL;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'author',
        'content',
        'validated',
        'views',
    ];

    protected $attributes = [
        'validated' => false,
        'views' => 0,
    ];

    protected $casts = [
        'validated' => 'boolean',
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

    public function scopeValidated(Builder $query): Builder
    {
        return $query->where('validated', '=', true);
    }

    public function scopeNotValidated(Builder $query): Builder
    {
        return $query->where('validated', '=', false);
    }

    public function temporaryValidationUrl(): string
    {
        return URL::signedRoute('quotes.validate', ['quoteHash' => $this->hash]);
    }
}
