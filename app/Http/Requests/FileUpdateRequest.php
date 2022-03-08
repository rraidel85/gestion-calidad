<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileUpdateRequest extends FormRequest
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
            'name' => ['required', 'max:255', 'string'],
            'file' => ['file', 'mimes:doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip'],
            'categories' => ['array', 'exists:categories,id'],
        ];
    }
}
