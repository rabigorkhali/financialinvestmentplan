<?php

namespace App;

use App\Model\Role;
use App\Model\UserPassword;
use Config;
use Spatie\Activitylog\LogOptions;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'token', 'password_resetted', 'expiry_datetime','role_id', 'is_2fa_enabled', 'two_fa_expiry_time','contact','image'
    ];

    protected $guarded = [
        'id',
    ];

    protected static $logAttributes = ['name', 'email', 'username', 'is_2fa_enabled','contact'];

    protected static $ignoreChangedAttributes = ['password', 'password_resetted', 'token', 'remember_token', 'updated_at'];

    protected static $logName = 'User';

    protected static $logOnlyDirty = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        return logMessage('User', $this->id, $eventName);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(fn(string $eventName) => $this->getDescriptionForEvent($eventName))
            ->useLogName(self::$logName)
            ->logOnly(self::$logAttributes)
            ->logOnlyDirty();
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

//    public function role()
//    {
//        return $this->belongsTo(Role::class, 'role_id', 'id');
//    }

    public function userPasswords()
    {
        return $this->hasMany(UserPassword::class, 'user_id', 'id');
    }

    public function logs()
    {
        return $this->hasMany(Log::class, 'causer_id', 'id');
    }

    public function loginLogs()
    {
        return $this->hasMany(Log::class, 'user_id', 'id');
    }

    public function getPasswordSetResetLink($check, $token)
    {
        $title = 'Reset Password';
        $key = 'reset-password';
        if ($check) {
            $title = 'Set Password';
            $key = 'set-password';
        }
        $link = '' . Config::get('constants.URL') . '/' . getSystemPrefix() . '/' . $key . '/' . $this->email . '/' . $token . '';
        return '<a href=' . $link . '>' . $title . '</a>';
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function setUsernameAttribute($value)
    {
        $this->attributes['username'] = strtolower($value);
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }
}
