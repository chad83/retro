<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = ['session_id', 'name', 'session_rating', 'color'];

    protected $hidden = ['id', 'session_id', 'created_at', 'updated_at'];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function session(): BelongsTo
    {
        return$this->belongsTo(Session::class);
    }
}
