<?php

namespace App\Models\Admin;

use App\Models\Admin\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Advance extends Model
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
        Cache::has('advances') ? Cache::forget('advances') : '';
    }

    // Logs
    protected static $logName = 'advance';

    // Relation
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
