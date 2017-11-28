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
            'title' => 'required|unique:posts|max:255',
            'text' => 'required',
            'image'=>'image|mimes:jpg,png|required',
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
    public function post_update(){
            $inputs = $this->all();
            $inputs = $this->except(['_token']);
            $inputs = $this->except(['_method']);
            if($this->hasFile('image')) {    
            $image = $this->file('image');
            $inputs['image'] = time().'.'.$image->getClientOriginalName();
            $image->move(public_path('/image'), $inputs['image']);
        } 
        else {    
            $inputs['image']='no-image.png';
        }
            $inputs['user_id'] = Auth::id();
            return $inputs;
            return $inputs;
    }
    public function post_store(){
            $inputs = $this->all();
            $inputs = $this->except(['_token']);
            if($this->hasFile('image')) {    
            $image = $this->file('image');
            $inputs['image'] = time().'.'.$image->getClientOriginalName();
            $image->move(public_path('/image'), $inputs['image']);
        } 
        else {    
            $inputs['image']='no-image.png';
        }
            $inputs['user_id'] = Auth::id();
            return $inputs;
    
    }
}
