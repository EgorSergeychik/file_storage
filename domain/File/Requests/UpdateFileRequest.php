<?php

namespace Domain\File\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'file_id' => [
                'required',
                Rule::exists('files', 'id')
                    ->where('user_id', $this->user()->id)
            ],
            'name' => [
                'required',
                'string',
                'max:255',
                'min:3',
            ],
        ];
    }
}
