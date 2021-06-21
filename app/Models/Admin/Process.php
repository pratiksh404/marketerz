<?php

namespace App\Models\Admin;

use App\Models\Admin\Contact;
use App\Models\Admin\Campaign;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Process extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Accessors
    public function getStatusAttribute($attribute)
    {
        return [
            0 => 'Processing',
            1 => 'Success',
            2 => 'Failed',
            3 => 'Retry'
        ][$attribute];
    }

    public function getChannelAttribute($attribute)
    {
        return [
            1 => 'Email',
            2 => 'SMS'
        ][$attribute];
    }

    // Helper Function
    public function color($value)
    {
        return isset($value) ? [
            0 => 'warning',
            1 => 'success',
            2 => 'danger',
            3 => 'info',
            4 => 'secondary'
        ][$value] : 'default';
    }

    // Relation
    public function contact()
    {
        return $this->belongsTo(Contact::class, 'contact_id');
    }
    public function campaign()
    {
        return $this->belongsTo(Campaign::class, 'campaign_id');
    }
}
