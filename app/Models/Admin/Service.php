<?php

namespace App\Models\Admin;

use App\Models\Admin\Lead;
use App\Models\Admin\Package;
use App\Models\Admin\Project;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Service extends Model
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
        Cache::has('services') ? Cache::forget('services') : '';
    }

    // Logs
    protected static $logName = 'service';

    // Accessor
    public function getTypeAttribute($attribute)
    {
        return [
            1 => 'Per Unit',
            2 => 'Per Day',
            3 => 'Per Week',
            4 => 'Per Month',
            5 => 'Per Year',
        ][$attribute];
    }

    public function packages()
    {
        return $this->belongsToMany(Package::class)->withPivot('quantity', 'price')->withTimestamps();
    }
    public function leads()
    {
        return $this->belongsToMany(Lead::class)->withTimestamps();
    }
    public function projects()
    {
        return $this->belongsToMany(Project::class)->withTimestamps();
    }
}
