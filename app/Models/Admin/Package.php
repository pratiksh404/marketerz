<?php

namespace App\Models\Admin;

use App\Models\Admin\Department;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Package extends Model
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
        Cache::has('packages') ? Cache::forget('packages') : '';
    }

    // Logs
    protected static $logName = 'package';

    public function services()
    {
        return $this->belongsToMany(Service::class)->withTimestamps();
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
