<?php

namespace App\Repositories\System;

use App\Exceptions\NotDeletableException;
use App\Interfaces\System\LanguageInterface;
use App\Model\Language;
use App\Repositories\Repository;

class LanguageRepository extends Repository implements LanguageInterface
{
    public function __construct(private readonly Language $language, private readonly CountryRepository $countryRepository)
    {
        parent::__construct($language);
    }

    public function getAllData($data, $selectedColumns = [], $pagination = true)
    {
        $query = $this->query();
        if (isset($data->keyword)) {
            $query->where(function ($q) use ($data) {
                $q->where('name', 'ILIKE', '%' . $data->keyword . '%')
                    ->orWhere('language_code', 'ILIKE', '%' . $data->keyword . '%');
            });
        }
        if (count($selectedColumns) > 0) {
            $query->select($selectedColumns);
        }
        if ($pagination) {
            return $query->orderBy('id', 'ASC')->paginate(PAGINATE);
        }

        return $query->orderBy('id', 'ASC')->get();
    }

    public function create($request)
    {
        $country = $this->countryRepository->itemByIdentifier($request->get('country_id'));
        $languages = json_decode($country->languages);
        $name = '';
        $languageCode = '';
        foreach ($languages as $language) {
            if ($language->iso639_1 == $request->get('language_code')) {
                $name = $language->name;
                $languageCode = $language->iso639_1;
                break;
            }
        }
        return $this->model->create([
            'name' => $name,
            'language_code' => $languageCode,
        ]);
    }

    public function delete($request, $id)
    {
        $language = $this->itemByIdentifier($id);
        if ($language->isDefault()) {
            throw new NotDeletableException();
        }
        return $language->delete();
    }

    public function getLanguages()
    {
        return $this->model->get();
    }

    public function getKeyValuePair($languages, $key = 'language_code', $value = 'name')
    {
        $options = [];
        foreach ($languages as $language) {
            $options[$language[$key]] = $language[$value];
        }

        return $options;
    }

    public function pluckLanguages()
    {
        return $this->model->pluck('language_code')->toArray();
    }
}
