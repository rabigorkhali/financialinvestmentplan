<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Loginlogs extends Model
{
    use LogsActivity;

    protected $fillable = [
        'user_id', 'ip', 'city', 'country', 'isp', 'lat', 'lon', 'timezone', 'region_name',
    ];
    protected static $logAttributes = [
        'user_id', 'ip', 'city', 'country', 'isp', 'lat', 'lon', 'timezone', 'region_name',
    ];
    protected static $logName = 'LoginLog';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return logMessage('LoginLogs', $this->id, $eventName);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(fn(string $eventName) => $this->getDescriptionForEvent($eventName))
            ->useLogName(self::$logName)
            ->logOnly(self::$logAttributes)
            ->logOnlyDirty();
    }
}
