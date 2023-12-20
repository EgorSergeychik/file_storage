<?php

namespace Domain\Folder\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateFolderRequest extends FormRequest
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
            'folder_id' => [
                'nullable',
                'integer',
                function ($attribute, $value, $fail) {
                    if ($value != null && $this->user()->folders()->where('id', $value)->doesntExist()) {
                        $fail('The selected parent folder is invalid.');
                    }
                },
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
