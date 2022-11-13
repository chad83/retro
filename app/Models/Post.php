<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $attributes = [
        'is_starred' => 0,
        'likes' => 0
    ];

    protected $fillable = ['session_id', 'participant_id', 'category', 'text'];

    protected $hidden = ['id', 'session_id', 'participant_id', 'created_at', 'updated_at'];

    public function participant(): BelongsTo
    {
        return$this->belongsTo(Participant::class);
    }

    public function session(): BelongsTo
    {
        return$this->belongsTo(Session::class);
    }
}
