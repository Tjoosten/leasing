<?php

namespace App\Http\Requests\Lokalen;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class WerkpuntValidator
 * 
 * @package App\
 */
class WerkpuntValidator extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->hasAnyRole('admin', 'leiding');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'lokalen_id'        => ['required', 'integer'], 
            'title'             => ['required', 'string', 'max:191'],
            'extra_informatie'  => ['required', 'string'],
        ];
    }
}
