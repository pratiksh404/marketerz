<?php

namespace App\Models\Admin;

use App\Models\User;
use App\Models\Admin\Group;
use App\Models\Admin\Client;
use App\Models\Admin\Process;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Campaign extends Model
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
        Cache::has('campaigns') ? Cache::forget('campaigns') : '';
    }

    // Logs
    protected static $logName = 'campaign';

    // Casts
    protected $casts = [
        'contacts' => 'array'
    ];


    // Accessor
    public function getChannelAttribute($attribute)
    {
        return [
            1 => 'Email',
            2 => 'SMS'
        ][$attribute];
    }

    // Relation 
    public function campaigner()
    {
        return $this->belongsTo(User::class, 'campaign_by');
    }
    public function processes()
    {
        return $this->hasMany(Process::class);
    }
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    // Scopes
    public function scopeEmail($query)
    {
        return $query->where('channel', 1);
    }
    public function scopeSMS($query)
    {
        return $query->where('channel', 2);
    }
}
