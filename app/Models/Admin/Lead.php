<?php

namespace App\Models\Admin;

use App\Models\User;
use App\Models\Admin\Source;
use App\Models\Admin\Contact;
use App\Models\Admin\Service;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Lead extends Model
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
        Cache::has('leads') ? Cache::forget('leads') : '';
    }

    // Logs
    protected static $logName = 'lead';

    // Relations
    public function source()
    {
        return $this->belongsTo(Source::class, 'source_id');
    }
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
    public function contact()
    {
        return $this->belongsTo(Contact::class, 'contact_id');
    }
    public function leadBy()
    {
        return $this->belongsTo(User::class, 'lead_by');
    }
    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
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
    public function getProgressPercent()
    {
        return [
            1 => 0,
            2 => 30,
            3 => 0,
            4 => 50,
            5 => 70,
            6 => 100,
            7 => 0,
            8 => 100
        ][$this->status];
    }
}
