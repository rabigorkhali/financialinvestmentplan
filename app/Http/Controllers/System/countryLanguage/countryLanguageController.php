<?php

namespace App\Http\Controllers\System\countryLanguage;

use App\Http\Controllers\Controller;
use App\Repositories\System\CountryRepository;
use App\Services\System\CountryService;

class countryLanguageController extends Controller
{
    public function __construct(private readonly CountryRepository $countryRepository)
    {
    }

    public function getLanguages($countryId)
    {
        $languages = $this->countryRepository->itemByIdentifier($countryId);

        return response()->json(['languages' => json_decode($languages->languages)]);
    }
}
