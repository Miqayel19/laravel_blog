<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'title' => 'max:255',
        ];
    }
    public function storeInputs()
    {
        $inputs = $this->all();
        return $inputs;
    }
    public function updateInputs()
    {
        $inputs = $this->all();
        return $inputs;
    }
}
