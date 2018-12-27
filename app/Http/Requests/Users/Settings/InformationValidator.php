<?php

namespace App\Http\Requests\Users\Settings;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class Information Validation
 * 
 * @package App\Http\Requests\Users\Settings
 */
class InformationValidator extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // No authorization needed because the handling impacts only the authenticated user. 
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}
