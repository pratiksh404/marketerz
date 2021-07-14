<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Project extends Model
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
        Cache::has('projects') ? Cache::forget('projects') : '';
    }

    // Logs
    protected static $logName = 'project';

    // Casts
    protected $casts = [
        'team_channel' => 'array',
        'client_channel' => 'array',
    ];

    // Relations
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
    public function lead()
    {
        return $this->belongsTo(Lead::class, 'lead_id');
    }
    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
    public function projectHead()
    {
        return $this->belongsTo(User::class, 'project_head');
    }
    public function projects()
    {
        return $this->belongsToMany(Project::class)->withTimestamps();
    }
}
