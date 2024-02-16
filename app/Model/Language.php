<?php

namespace App\Model;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;


class Language extends Model
{
    use LogsActivity;

    protected $fillable = [
        'name', 'language_code',
    ];

    protected static $logAttributes = ['name', 'language_code'];

    protected static $logName = 'Language';

    protected static $logOnlyDirty = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        return logMessage('Language', $this->id, $eventName);
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->setDescriptionForEvent(fn (string $eventName) => $this->getDescriptionForEvent($eventName))
        ->useLogName(self::$logName)
        ->logOnly(self::$logAttributes)
        ->logOnlyDirty();
    }



    public function isDefault()
    {
        if (in_array($this->language_code, ['en', 'ja'])) {
            return true;
        } else {
            return false;
        }
    }
}
