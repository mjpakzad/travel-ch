<?php
namespace App\Http\Requests\Search;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'startDate' => 'nullable|date|after_or_equal:now',
            'endDate'   => 'nullable|date|after_or_equal:startDate',
        ];
    }

    public function getStartDate()
    {
        return $this->input('startDate') ?? today()->toDateString();
    }

    public function getEndDate()
    {
        return $this->input('endDate') ?? today()->addWeeks(2)->toDateString();
    }
}
