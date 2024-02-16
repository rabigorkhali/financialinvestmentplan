<?php

namespace App\Services\System;

use App\Exceptions\CustomGenericException;
use App\Model\Locale;
use App\Repositories\System\CountryRepository;
use App\Repositories\System\LanguageRepository;
use App\Services\Service;
use Illuminate\Support\Facades\DB;
use File;

class LanguageService extends Service
{
    public function __construct(private readonly LanguageRepository $languageRepository,
                                private readonly CountryService     $countryService,
                                private readonly CountryRepository  $countryRepository)
    {
        parent::__construct($languageRepository);
    }

    public function createPageData($request)
    {
        $countries = $this->countryRepository->getAllData($request, ['id', 'name', 'languages', 'flag'], false);
        return [
            'countriesOptions' => $this->countryService->extractKeyValuePair($countries),
        ];
    }

    public function store($request)
    {
        try {
            DB::beginTransaction();
            $language = $this->repository->create($request);

            $jsonFileName = "en.json";
            $enJsonFilePath = resource_path('lang') . '/' . $jsonFileName;

            $createdFilePath = resource_path('lang') . '/' . $language->language_code . '.json';

            if (file_exists($enJsonFilePath)) {
                copy($enJsonFilePath, $createdFilePath);
            }

            DB::commit();
            return $language;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new CustomGenericException($e->getMessage());
        }
    }

    public function delete($request, $id)
    {
        $item = $this->repository->itemByIdentifier($id);
        $filename = $item->language_code . '.json';
        $filePath = resource_path('lang/' . $filename);

        if (File::exists($filePath)) {
            File::delete($filePath);
            // File deleted successfully
        }
        return $this->repository->delete($request, $id);
    }

    public function getBackendLanguages()
    {
        return $this->languageRepository->getLanguages();
    }
}
