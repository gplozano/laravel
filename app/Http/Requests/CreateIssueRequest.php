<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateIssueRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'services' => 'required|array',
            'issue' => 'required',
            'summary' => 'required|min:5',
            'details' => 'required',
            'type' => 'required',
            'open_date' => 'required|date_format:m/d/Y',
            'open_time' => 'required|date_format:h:i A',
            'close_date' => 'required_with:close_time|date_format:m/d/Y',
            'close_time' => 'required_with:close_date|date_format:h:i A',
            // 'domain_hosts' => 'required_without:domains|array',
            // 'domains'       => 'required_without:domain_hosts|array'
            //
        ];
    }
}
