<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $guarded = ['editable'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'editable',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'datetime',
        'time' => 'datetime',
        'flight_time' => 'datetime',
        'editable' => 'boolean',
    ];

    public function setFlightTimeAttribute($value)
    {
        $this->attributes['flight_time'] = strlen($value) ? $value : null;
    }

    /**
     * Get the driver that owns the service.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the driver that owns the order.
     */
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    /**
     * Get the driver that owns the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
