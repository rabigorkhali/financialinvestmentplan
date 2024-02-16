<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class EmailTemplate extends Model
{
    use LogsActivity;

    protected $fillable = [
        'title', 'code', 'from','placeholders'
    ];

    protected static $logAttributes = ['title', 'code', 'from'];

    protected static $logName = 'Email Template';

    protected static $logOnlyDirty = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        return logMessage('Email-template', $this->id, $eventName);
    }

    public function emailTranslations()
    {
        return $this->hasMany(EmailTemplateTranslation::class, 'email_template_id', 'id');
    }

    public function emailTranslationWithLocale()
    {
        return $this->hasOne(EmailTemplateTranslation::class, 'email_template_id', 'id')->where('language_code', app()->getLocale());
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(fn(string $eventName) => $this->getDescriptionForEvent($eventName))
            ->useLogName(self::$logName)
            ->logOnly(self::$logAttributes)
            ->logOnlyDirty();
    }

    public function getContentByLanguage($language_code = 'en', $key = null)
    {
        $translations = $this->emailTranslations->where('language_code', $language_code)->first();
        if (isset($translations)) {
            if ($key != null) {
                $translations = $translations->$key;
            }
        } else {
            $translations = $this->emailTranslations->where('language_code', 'en')->first();
            if (isset($translations)) {
                if ($key != null) {
                    $translations = $translations->$key;
                }
            } else {
                $translations = null;
            }
        }

        return $translations;
    }
}
