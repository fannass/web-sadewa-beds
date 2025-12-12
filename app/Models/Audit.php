<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'user_id',
        'old_status',
        'new_status',
        'notes',
    ];

    /**
     * Get the room this audit belongs to
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Get the user who made this audit
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
