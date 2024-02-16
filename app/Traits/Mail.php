<?php

namespace App\Traits;

use App\Model\EmailTemplate;
use Config;

trait Mail
{
    public function parseEmailTemplate($data, $emailCode, $locale = 'en')
    {
        $replace = [];
        $with = [];

        if (isset($data)) {
            $emailTemplate = EmailTemplate::where('code', $emailCode)->with('emailTranslations')->first();
            $translation = $emailTemplate->getContentByLanguage($locale);
            if ($translation == null) {
                $translation = $emailTemplate->getContentByLanguage('en');
            }
            foreach ($data as $key => $value) {
                array_push($replace, $key);
                array_push($with, $value);
            }
            $message_body = $translation->template;
            $this->subject($translation->subject);
            $this->from(env('MAIL_FROM_ADDRESS') ?? Config::get('constants.FROM_MAIL'), Config::get('constants.FROM_NAME'));
            $content = str_replace($replace, $with, $message_body);

            return $content;
        }
    }
}
