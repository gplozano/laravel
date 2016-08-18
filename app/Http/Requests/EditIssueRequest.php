<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EditIssueRequest extends Request
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
            'issue' => 'required',
            'close_date' => 'required_with:close_time|date_format:m/d/Y',
            'close_time' => 'required_with:close_date|date_format:h:i A',
            'type' => 'required',
            'summary' => 'required',
            
            //
        ];
    }
}
