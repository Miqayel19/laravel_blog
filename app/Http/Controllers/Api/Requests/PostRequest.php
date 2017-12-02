<?php

namespace App\Http\Controllers\Api\Requests;

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
        $info = $this->all();
        $info = $this->except(['_token']);
        $info = $this->except(['_method']);
        $info['user_id'] = Auth::id();
        return $info;
    }
    public function postStore()
    {
        $info = $this->all();
        $info = $this->except(['_token']);
        $info['user_id'] = Auth::id();
        return $info;
    }
}
