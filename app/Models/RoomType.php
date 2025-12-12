<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    protected $fillable = [
        'name',
        'description',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class, 'room_type', 'name');
    }

    public static function getActiveTypes()
    {
        return self::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->pluck('name', 'name');
    }
}
