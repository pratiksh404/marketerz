<?php

namespace App\Models\Admin;

use App\Models\Admin\Group;
use App\Models\Admin\Process;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
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
        Cache::has('contacts') ? Cache::forget('contacts') : '';
    }

    // Logs
    protected static $logName = 'contact';

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
    public function scopeInActive($query)
    {
        return $query->where('active', 0);
    }
    public function scopeFavorite($query)
    {
        return $query->where('favorite', 1);
    }
    public function scopeNonFavorite($query)
    {
        return $query->where('favorite', 0);
    }

    // Relations
    public function groups()
    {
        return $this->belongsToMany(Group::class)->withTimestamps();
    }
    public function clients()
    {
        return $this->belongsToMany(Client::class)->withTimestamps();
    }
    public function processes()
    {
        return $this->hasMany(Process::class);
    }
}
