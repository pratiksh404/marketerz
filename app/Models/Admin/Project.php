<?php

namespace App\Models\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin\Lead;
use App\Models\Admin\Client;
use App\Models\Admin\Package;
use App\Models\Admin\Payment;
use App\Models\Admin\Service;
use App\Models\Admin\Department;
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

    // Appends
    protected $appends = ['remaining_amount', 'deadline_percent', 'valid_price'];

    public function getRemainingAmountAttribute()
    {
        return $this->paid_amount > $this->price ? 0
            : $this->price - $this->paid_amount;
    }
    public function getDeadlinePercentAttribute()
    {
        $start = Carbon::create($this->project_startdate);
        $end = Carbon::create($this->project_deadline);
        $now = Carbon::now();
        $interval = $start->diffInDays($end);
        $remaining_days = $now->diffInDays($end);
        return $remaining_days == 0 ? 100 : (($remaining_days / $interval) * 100);
    }
    public function getValidPriceAttribute()
    {
        if (isset($this->discounted_price)) {
            if ($this->discounted_price > 0) {
                return $this->discounted_price;
            }
        }
        return $this->price;
    }

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
    public function services()
    {
        return $this->belongsToMany(Service::class)->withTimestamps();
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
