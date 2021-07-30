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
            5 => 'Conversation',
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
            5 => 'success',
        ][$this->getRawOriginal('type')];
    }
    public function getChannel($channel)
    {
        return [
            1 => 'mail',
            2 => 'sms',
            3 => 'slack',
            4 => 'database'
        ][$channel];
    }
    public function getIcon()
    {
        return [
            1 => 'fa fa-comments',
            2 => 'fa fa-check',
            3 => 'fa fa-fire',
            4 => 'fa fa-exclamation',
            5 => 'fa fa-comments-o'
        ][$this->getRawOriginal('type')];
    }
    public function getChannelArray()
    {
        $channels = [];
        if (isset($this->channel)) {
            foreach ($this->channel as $channel) {
                $channels[] = $this->getChannel($channel);
            }
        }
        return $channels;
    }
}
