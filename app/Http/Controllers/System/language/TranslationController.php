<?php

namespace App\Http\Controllers\System\language;

use App\Exports\TranslationExport;
use App\Http\Controllers\System\ResourceController;
use App\Http\Requests\system\uploadExcel;
use App\Imports\TranslationImport;
use App\Repositories\System\LanguageRepository;
use App\Services\System\TranslationService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TranslationController extends ResourceController
{
    public function __construct(private readonly TranslationService $translationService,
                                private readonly LanguageRepository $languageRepository)
    {
        parent::__construct($translationService);
    }

    public function moduleName()
    {
        return 'translations';
    }

    public function storeValidationRequest()
    {
        return 'App\Http\Requests\system\translationRequest';
    }


    public function viewFolder()
    {
        return 'system.translation';
    }

    public function update($id)
    {
        $request = app()->make($this->storeValidationRequest());
        $this->service->update($request, $id);

        return response()->json(['status' => 'OK'], 200);
    }

    public function downloadSample()
    {
        $file_path = public_path('sampleTranslation/sample.xls');

        return response()->download($file_path);
    }

    public function downloadExcel(Request $request)
    {
        $translate = [];
        $filename = 'translation.xlsx';
        $langShortCodes = $this->languageRepository->pluckLanguages();

        foreach ($langShortCodes as $lang) {
            $jsonFileName = "{$lang}.json";
            $jsonFilePath = resource_path('lang') . '/' . $jsonFileName;

            if (file_exists($jsonFilePath)) {
                $existingContent = file_get_contents($jsonFilePath);
                $existingTranslations = json_decode($existingContent, true);
                $translate[$lang] = $existingTranslations;
            } else {
                $translate[$lang] = $translate['en'];
            }
        }

        // Initialize the new array
        $newArray = [];

        // Iterate over each language
        foreach ($translate as $languageCode => $translations) {
            // Iterate over each translation key
            if (isset($translations) && $translations != null) {
                foreach ($translations as $key => $translation) {
                    $newKey = strtolower(trim(str_replace(" ", "_", $key)));
                    $newArray[$newKey]['key'] = $key;
                    $newArray[$newKey][$languageCode] = $translation;
                }
            }
        }

        return Excel::download(new TranslationExport($newArray), $filename);
    }

    public function uploadExcel(uploadExcel $request)
    {
        $file = $request->excel_file;
        $fileExtension = $file->getClientOriginalExtension();
        if (!in_array($fileExtension, ['xlsx', 'xls'])) {
            return back()->withErrors(['alert-danger' => 'The file type must be xls or xlsx!']);
        }

        try {
            $contents = \Excel::import(new TranslationImport(), $file);
            $uploadedData = $contents->toArray($contents, $file);

            if (count($uploadedData[0]) <= 1) {
                return back()->withErrors(['alert-danger' => 'The file does not contain any translation content']);
            }
            $heading = $this->removeSpacesHeading($uploadedData[0][0]);
            $langShortCodes = $this->languageRepository->pluckLanguages();

            array_unshift($langShortCodes, 'key');

            $checkValid = array_diff($heading, $langShortCodes);

            if (count($checkValid) > 0) {
                return back()->withErrors(['alert-danger' => 'Invalid translation content or the provided language may not be available.']);
            }
            unset($uploadedData[0][0]); // removing header content from file

            $this->parseAndUploadData($uploadedData, $heading);

            return back()->withErrors(['alert-success' => 'The translations successfully uploaded.']);
        } catch (\Exception $e) {
            return back()->withErrors(['alert-danger' => 'There was some problem in uploading translations.']);
        }
    }

    public function removeSpacesHeading($heading)
    {
        $removed = [];
        foreach ($heading as $key => $value) {
            $removed[$key] = strtolower(trim($value));
        }

        return $removed;
    }

    public function parseAndUploadData($data, $heading)
    {
        $langShortCodes = $this->languageRepository->pluckLanguages();
        $directory = resource_path('lang');

        // Create the directory if it doesn't exist
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        foreach ($langShortCodes as $lang) {
            $jsonFilePath = "{$directory}/{$lang}.json";

            // Read existing data from the file or initialize with an empty array
            $existingData = file_exists($jsonFilePath) ? json_decode(file_get_contents($jsonFilePath), true) : [];

            if (in_array($lang, $heading)) {
                // Get new translation data
                $filteredNewTrans = $this->getTranslation($heading, $lang, $data[0]);

                // Merge existing data with new data
                $combinedData = array_merge($existingData, $filteredNewTrans);

                // Convert the combined data to JSON
                $jsonContentString = json_encode($combinedData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

                // Write the combined data back to the file
                file_put_contents($jsonFilePath, $jsonContentString);
            }
        }
    }

// Define a function to filter translations by language code
    public function getTranslation($heading, $languageCode, $translationsArray)
    {
        // Find the index of the language in the heading array
        $langIndex = array_search($languageCode, $heading);

        if ($langIndex !== false) {
            // Use array_column to extract the specific column for the language
            $languageTranslations = array_column($translationsArray, $langIndex, 0);

            // Remove entries with null or empty translations
            $filteredData = array_filter($languageTranslations, function ($translation) {
                return $translation !== null && $translation !== '';
            });

            return $filteredData;
        }

        return [];
    }

}
