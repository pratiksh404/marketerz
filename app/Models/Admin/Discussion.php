<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Discussion extends Model
{
    use LogsActivity;

    protected $guarded = [];

    // Forget cache on updating or saving and deleting
    public static function boot()
    {
        parent::boot();

        static::saving(function () {
            self::cacheKey();
        });

        static::deleting(function () {
            self::cacheKey();
        });
    }

    // Cache Keys
    private static function cacheKey()
    {
        Cache::has('discussions') ? Cache::forget('discussions') : '';
    }

    // Logs
    protected static $logName = 'discussion';

    // Casts
    protected $casts = [
        'channel' => 'array'
    ];

    // Relation
    public function lead()
    {
        return $this->belongsTo(Lead::class, 'lead_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Accessors
    public function getStatus()
    {
        return [
            1 => 'New',
            2 => 'Qualified',
            3 => 'Unqualified',
            4 => 'Discussion',
            5 => 'Negotiation',
            6 => 'Won',
            7 => 'Lost',
            8 => 'Follow Up'
        ][$this->status];
    }
    public function getTypeAttribute($attribute)
    {
        return [
            1 => 'Feedback',
            2 => 'Request',
            3 => 'Demand',
            4 => 'Complain',
        ][$attribute];
    }

    // Helper Function
    public function getStatusColor()
    {
        return [
            1 => 'primary',
            2 => 'secondary',
            3 => 'danger',
            4 => 'info',
            5 => 'warning',
            6 => 'success',
            7 => 'danger',
            8 => 'grey'
        ][$this->status];
    }
    public function getTypeColor()
    {
        return [
            1 => 'primary',
            2 => 'warning',
            3 => 'info',
            4 => 'danger',
        ][$this->status];
    }
}
