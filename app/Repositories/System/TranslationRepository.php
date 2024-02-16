<?php

namespace App\Repositories\System;

use App\Exceptions\CustomGenericException;
use App\Interfaces\System\TranslationInterface;
use App\Model\Locale;
use App\Repositories\Repository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class TranslationRepository extends Repository implements TranslationInterface
{
    public function __construct(private readonly Locale $locale, LanguageRepository $languageRepository)
    {
        parent::__construct($locale);
        $this->languageRepository = $languageRepository;
    }

    public function getAllData($data, $selectedColumns = [], $pagination = true)
    {
        $langShortCodes = $this->languageRepository->pluckLanguages();
        $jsonContent = new Collection();

        foreach ($langShortCodes as $lang) {
            $jsonFileName = "{$lang}.json";
            $jsonFilePath = resource_path('lang') . '/' . $jsonFileName;

            $jsonData = file_exists($jsonFilePath) ? json_decode(file_get_contents($jsonFilePath), true) : null;

            // Directly assign the decoded JSON data to the collection
            $jsonContent[$lang] = $jsonData;
        }

        if (isset($data->keyword) && $data->keyword !== null) {
            // Filter based on the keyword in each language's JSON data
            $jsonContent = $jsonContent->map(function ($jsonData) use ($data) {
                return collect($jsonData)->filter(function ($value, $key) use ($data) {
                    return stripos($value, $data->keyword) !== false;
                });
            });
        }

        if (isset($data->locale) && $data->locale !== null) {
            // Filter based on the locale in the language keys
            $jsonContent = $jsonContent->filter(function ($collection, $lang) use ($data) {
                return stripos($lang, $data->locale) !== false;
            });
        } else {
            // Filter based on the locale in the language keys
            $jsonContent = $jsonContent->filter(function ($collection, $lang) use ($data) {
                return stripos($lang, 'en') !== false;
            });
        }

        // Merge all collections into a single collection
        $mergedCollection = $jsonContent->collapse();

        // Paginate the merged collection
        $perPage = PAGINATE; // Number of items per page
        $page = request()->get('page', 1); // Get the current page from the request

        return new LengthAwarePaginator(
            $mergedCollection->forPage($page, $perPage),
            $mergedCollection->count(),
            $perPage,
            $page
        );

    }

    public function update($request, $data)
    {
        return $data->update(['text' => $data]);
    }

    public function delete($request, $key)
    {
        return $this->removeFromJsonFile($key);
    }

    public function removeFromJsonFile($keyToRemove)
    {
        $langShortCodes = $this->languageRepository->pluckLanguages();

        foreach ($langShortCodes as $lang) {
            $jsonFileName = "{$lang}.json";

            $jsonFilePath = resource_path('lang') . '/' . $jsonFileName;

            if (file_exists($jsonFilePath)) {
                // Read the JSON file
                $jsonContent = file_get_contents($jsonFilePath);

                // Convert JSON to an associative array
                $data = json_decode($jsonContent, true);

                if ($data === null) {
                    throw new CustomGenericException('Something went wrong');
                }

                // Check if the key exists before removing it
                if (array_key_exists($keyToRemove, $data)) {
                    // Remove the desired key from the associative array
                    unset($data[$keyToRemove]);

                    // Encode the modified array back to JSON
                    $newJsonContent = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

                    if ($newJsonContent === false) {
                        throw new CustomGenericException('Something went wrong');
                    }

                    // Save the modified JSON content back to the file
                    file_put_contents($jsonFilePath, $newJsonContent);

                }
            }
        }
        return true;
    }
}
