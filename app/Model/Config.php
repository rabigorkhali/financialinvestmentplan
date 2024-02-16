<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Config extends Model
{
    use LogsActivity;

    protected $fillable = [
        'label', 'type', 'value',
    ];

    protected static $logAttributes = ['label', 'type', 'value'];

    protected static $logName = 'Config';

    protected static $logOnlyDirty = true;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->setDescriptionForEvent(fn (string $eventName) => $this->getDescriptionForEvent($eventName))
        ->useLogName(self::$logName)
        ->logOnly(self::$logAttributes)
        ->logOnlyDirty();
    }
    public function getDescriptionForEvent(string $eventName): string
    {
        return logMessage('Config', $this->id, $eventName);
    }

    public function isFile($type)
    {
        if (strtolower($type) == 'file') {
            return true;
        } else {
            return false;
        }
    }

    public function isText($type)
    {
        if (strtolower($type) == 'text') {
            return true;
        } else {
            return false;
        }
    }

    public function isTextArea($type)
    {
        if (strtolower($type) == 'textarea') {
            return true;
        } else {
            return false;
        }
    }

    public function isNumber($type)
    {
        if (strtolower($type) == 'number') {
            return true;
        } else {
            return false;
        }
    }

    public function isColorPicker($id)
    {
        if ($id == '3') {
            return true;
        } else {
            return false;
        }
    }

    public function isDefault($id)
    {
        if (in_array($id, [1, 2, 3])) {
            return true;
        } else {
            return false;
        }
    }
}
