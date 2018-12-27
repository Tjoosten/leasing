<?php

namespace App\Http\Requests\Lokalen;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class InformationValidator 
 * 
 * @package App\Http\Requests\Lokalen
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
        return auth()->check() && auth()->user()->hasAnyRole(['leiding', 'admin']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'              => ['required', 'string', 'max:191'],
            'capacity_type'     => ['required', 'string'], 
            'capacity'          => ['required', 'integer'],
            'verantwoordelijke' => ['required', 'integer'],
         ];
    }
}
