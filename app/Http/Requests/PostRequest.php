<?php

namespace App\Http\Requests;

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
    public function messages()
    {
        return [
            'title.required' => 'A title is Required',
            'text.required' => 'A text is Required',
            'image.required'=>'An image is Required',
        ];
    }
    public function postUpdate()
    {
        $inputs = $this->all();
        $inputs = $this->except(['_token']);
        $inputs = $this->except(['_method']);
        $inputs['user_id'] = Auth::id();
        return $inputs;
    }
    public function postStore()
    {
        $inputs = $this->all();
        $inputs = $this->except(['_token']);
        $inputs['user_id'] = Auth::id();
        return $inputs;
    }
}