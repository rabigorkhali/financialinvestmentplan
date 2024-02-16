<?php

namespace App\Services\System;

use App\Exceptions\CustomGenericException;
use App\Repositories\System\LanguageRepository;
use App\Repositories\System\TranslationRepository;
use App\Services\Service;

class TranslationService extends Service
{
    public function __construct(TranslationRepository     $translationRepository,
                                public LanguageRepository $languageRepository)
    {
        parent::__construct($translationRepository);
    }

    public function indexPageData($request)
    {
        $languages = $this->languageRepository->getAllData($request, ['name', 'language_code'], false);

        return [
            'items' => $this->repository->getAllData($request),
            'locales' => $this->languageRepository->getKeyValuePair($languages),
        ];
    }

    public function update($request, $key)
    {
        $currentLocale = $request->locale ?? 'en';
        $currentText = $request->text;
        $currentKey = $key;

        $jsonFileName = "{$currentLocale}.json";
        $jsonFilePath = resource_path('lang') . '/' . $jsonFileName;

        if (file_exists($jsonFilePath)) {
            $existingContent = file_get_contents($jsonFilePath);
            $existingTranslations = json_decode($existingContent, true);

            $filteredData[$currentKey] = $currentText;

            $mergedTranslations = array_merge($existingTranslations, $filteredData);

            $jsonContentString = json_encode($mergedTranslations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            file_put_contents($jsonFilePath, $jsonContentString);

            return true;
        }else{
            throw new  CustomGenericException('Something went wrong');
        }
    }

    public function delete($request, $id)
    {
        return $this->repository->delete($request, $id);
    }
}
