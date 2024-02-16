<?php

use App\Model\Language;

function translate($content, $data = [])
{
    $key = strtolower(trim(str_replace(".", "", $content)));

    $directory = resource_path('lang');
    if (!is_dir($directory)) {
        \File::makeDirectory($directory, $mode = 0755, true);
    }

    $locale = app()->getLocale();
    $jsonFileName = "{$locale}.json";
    $jsonFilePath = "{$directory}/{$jsonFileName}";

    if (file_exists($jsonFilePath)) {
        $translationsJSON = file_get_contents($jsonFilePath);
    } else {
        $translationsJSON = null;
    }

    // Convert JSON to array
    $translationsArray = json_decode($translationsJSON, true);
    $translationsArray = $translationsArray ?? [];


    if ($key !== '') {
        if (!in_array($key, array_keys($translationsArray))) {

            // If the key does not exist, add it to the array
            $translationsArray[$key] = $content; // Set a default translation value or replace it with your logic

            // Convert the array back to JSON
            $updatedJSON = json_encode($translationsArray, JSON_PRETTY_PRINT);

            // Save the updated JSON back to the file
            file_put_contents($jsonFilePath, $updatedJSON);

            return $content;
        } else {

            return $translationsArray[$key];
        }
    } else {
        return $key;
    }
}

function translateValidationErrorsOfApi($content, $data = [])
{
    return translate($content, $data);
}

//frontend tranalation function

function frontTrans($details, $data = [])
{
    return translate($details, $data);
}


