<?php

namespace App\Repositories\System;

use App\Interfaces\OpenInterface;
use App\Interfaces\System\EmailInterface;
use App\Model\EmailTemplate;
use App\Repositories\Repository;

class EmailRepository extends Repository implements EmailInterface
{
    public function __construct(private readonly EmailTemplate $emailTemplate)
    {
        parent::__construct($emailTemplate);
    }

    public function getAllData($data, $selectedColumns = [], $pagination = true)
    {
        $query = $this->query();

        if (isset($data->keyword) && $data->keyword !== null) {
            $query->where('title', 'ILIKE', '%' . $data->keyword . '%');
        }
        if (count($selectedColumns) > 0) {
            $query->select($selectedColumns);
        }
        if ($pagination) {
            return $query->orderBy('id', 'DESC')->paginate(PAGINATE);
        }

        return $query->orderBy('id', 'DESC')->get();
    }

    public function create($request)
    {
        $emailTemplate = $this->model->create($request->only('title', 'from'));
        $emailTemplate->emailTranslations()->createMany($request->get('multilingual'));
        return $emailTemplate;
    }

    public function update($request, $data)
    {
        $emailTranslation = $request->only('language_code', 'subject', 'template');
        $emailTemplate = $this->itemByIdentifier($request->email_template);
        $emailTemplate->emailTranslations()->delete();
        $emailTemplate = $emailTemplate->update($request->only('title', 'from','placeholders'));
        $emailTemplate = $this->itemByIdentifier($request->email_template);
        $emailTemplate->emailTranslations()->create($emailTranslation);
        return $emailTemplate;
    }

    public function delete($request, $id)
    {
        $emailTemplate = $this->itemByIdentifier($id);
        return $emailTemplate->delete();
    }
}
