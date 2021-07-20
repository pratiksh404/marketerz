<?php

namespace App\Models\Admin;

use App\Models\User;
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
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getPaymentMethodAttribute($attribute)
    {
        return [
            1 => 'Bank',
            2 => 'eSewa',
            3 => 'Khalti',
            4 => 'IMEPay'
        ][$attribute];
    }
    public function getPaymentMethodColor()
    {
        return [
            1 => 'primary',
            2 => 'success',
            3 => 'info',
            4 => 'warning'
        ][$this->getRawOriginal('payment_method')];
    }
}
