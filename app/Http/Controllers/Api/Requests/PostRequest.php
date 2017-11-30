<?php

namespace App\Http\Controllers\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use App\Category;
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
        if($this->hasFile('image')) {    
            $image = $this->file('image');
            $info['image'] = time().'.'.$image->getClientOriginalName();
            $image->move(public_path('/image'), $info['image']);
        } else {    
            $info['image']='no-image.png';
        }
        $info['user_id'] = Auth::id();
        return $info;
    }
    public function postStore()
    {
        $info = $this->all();
        $info = $this->except(['_token']);
        if($this->hasFile('image')) {    
            $image = $this->file('image');
            $info['image'] = time().'.'.$image->getClientOriginalName();
            $image->move(public_path('/image'), $info['image']);
        } else {    
            $info['image']='no-image.png';
        }
        $info['user_id'] = Auth::id();
        return $info;
    }
}
