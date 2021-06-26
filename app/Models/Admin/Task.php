<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;

class Task extends Model
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
        Cache::has('tasks') ? Cache::forget('tasks') : '';
    }

    // Logs
    protected static $logName = 'task';

    // Casts
    protected $casts = [
        'channel' => 'array'
    ];

    // Helper function
    public function getChannel($channel)
    {
        return [
            1 => 'Mail',
            2 => 'SMS',
            3 => 'Slack',
            4 => 'System Notification'
        ][$channel];
    }

    // Scopes
    public function scopeTenent($query)
    {
        return $query->where('user_id', Auth::user()->id)->orWhere('assigned_to', Auth::user()->id);
    }

    // Relation 
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
