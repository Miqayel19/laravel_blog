<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

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
        $inputs['user_id'] = Auth::id();
        return $inputs;
    }
    public function updateInputs()
    {   
        $inputs = $this->all();
        return $inputs;
    }
}
