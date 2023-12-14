<?php

namespace App\Models;

use App\Models\Scopes\GroupScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'storage_name',
        'group_id'
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new GroupScope());
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }
}
