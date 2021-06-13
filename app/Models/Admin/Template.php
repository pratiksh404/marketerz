<?php

namespace App\Models\Admin;

use App\Models\Admin\Contact;
use App\Services\TemplateTags;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Template extends Model
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
        Cache::has('templates') ? Cache::forget('templates') : '';
    }


    // Logs
    protected static $logName = 'template';

    // Accessors
    public function getTypeAttribute($attribute)
    {
        return [
            1 => 'Email',
            2 => 'SMS',
        ][$attribute];
    }

    // Helper Function
    public function getParsedMessage(Contact $contact)
    {
        return TemplateTags::parseTags($this->message, $contact);
    }

    // Scopes
    public function scopeEmail($query)
    {
        return $query->where('type', 1);
    }
    public function scopeSMS($query)
    {
        return $query->where('type', 2);
    }
}
