<?php

namespace App\Models\Admin;

use App\Models\Admin\Advance;
use App\Models\Admin\Contact;
use App\Models\Admin\Project;
use App\Models\Admin\Campaign;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use LogsActivity, HasFactory;

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
        Cache::has('clients') ? Cache::forget('clients') : '';
    }

    // Logs
    protected static $logName = 'client';
    // Relations
    public function contacts()
    {
        return $this->belongsToMany(Contact::class);
    }
    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
    public function advances()
    {
        return $this->hasMany(Advance::class);
    }
}
