<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Locale extends Model
{
    use LogsActivity;

    protected $table = 'language_lines';

    /** @var array */
    public $translatable = ['text'];

    /** @var array */
    public $guarded = ['id'];

    /** @var array */
    protected $casts = ['text' => 'array'];

    protected static $logAttributes = ['text'];

    protected static $logName = 'Translation';

    protected static $logOnlyDirty = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        return logMessage('Translation', $this->id, $eventName);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(fn(string $eventName) => $this->getDescriptionForEvent($eventName))
            ->useLogName(self::$logName)
            ->logOnly(self::$logAttributes)
            ->logOnlyDirty();
    }

//    public static function getTranslations(string $locale): array
//    {
//        return static::query()
//            ->get()
//            ->reduce(function ($lines, self $languageLine) use ($locale) {
//                $translation = $languageLine->getTranslation($locale);
//
//                if ($translation !== null) {
//                    $lines[$languageLine->key] = $translation;
//                }
//
//                return $lines;
//            }) ?? [];
//    }
//
//    public function getTranslation(string $locale): ?string
//    {
//        if (!isset($this->text[$locale])) {
//            $fallback = config('app.fallback_locale');
//
//            return $this->text[$fallback] ?? null;
//        }
//
//        return $this->text[$locale];
//    }
}
