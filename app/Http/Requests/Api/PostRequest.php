<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class PostRequest extends FormRequest
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
            'title' => 'required|max:255',
            'text' => 'required',
            'image'=>'required',
        ];
    }
    public function updateInputs()
    {
        $inputs = $this->except(['_method','_token']);
        $inputs['user_id'] = Auth::id();
        return $inputs;
    }
    public function storeInputs()
    {
        $inputs = $this->except(['_token']);
        $inputs['user_id'] = Auth::id();
        return $inputs;
    }
}
