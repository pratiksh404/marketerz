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
            1 => 'mail',
            2 => 'sms',
            3 => 'slack',
            4 => 'database'
        ][$channel];
    }
    public function getChannelArray()
    {
        $channels = [];
        if (isset($this->channel)) {
            foreach ($this->channel as $channel) {
                $channel[] = $this->getChannel($channel);
            }
        }
        return $channels;
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
