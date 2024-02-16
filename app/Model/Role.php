<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Role extends Model
{
    use LogsActivity;

    protected $casts = [
        'permissions' => 'array',
    ];

    protected $fillable = [
        'name', 'permissions',
    ];

    protected static $logAttributes = ['name', 'permissions'];

    protected static $logName = 'Roles';

    protected static $logOnlyDirty = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        return logMessage('Role', $this->id, $eventName);
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->setDescriptionForEvent(fn (string $eventName) => $this->getDescriptionForEvent($eventName))
        ->useLogName(self::$logName)
        ->logOnly(self::$logAttributes)
        ->logOnlyDirty();
    }

    public function users()
    {
        return $this->hasMany(User::class, 'role_id', 'id');
    }

    public function isEditable($id)
    {
        return $id == 1 ? false : true;
    }

    public function isDeletable($ids)
    {
        return $ids == 1 ? false : true;
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }
}
