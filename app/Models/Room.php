<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'room_type',
        'status',
        'floor',
        'bed_count',
        'facilities',
        'notes',
    ];

    /**
     * Get all audits for this room
     */
    public function audits()
    {
        return $this->hasMany(Audit::class);
    }

    /**
     * Get status badge color
     */
    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'tersedia' => 'green',
            'terisi' => 'red',
            'dibersihkan' => 'yellow',
            default => 'gray',
        };
    }

    /**
     * Get facilities as array
     */
    public function getFacilitiesArrayAttribute(): array
    {
        if (empty($this->facilities)) {
            return [];
        }
        return array_map('trim', explode(',', $this->facilities));
    }
}
