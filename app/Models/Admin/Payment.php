<?php

namespace App\Models\Admin;

use App\Models\User;
use App\Models\Admin\Project;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Payment extends Model
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
        Cache::has('payments') ? Cache::forget('payments') : '';
    }

    // Logs
    protected static $logName = 'payment';

    // Relation
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
