<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use App\Category;
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
    public function categoryStore()
    {
        $added_category = Category::create(['title' => $this->input('title'),'user_id' => Auth::id()]);
        $result = Category::where('user_id',Auth::id())->get();
        return $result;
    }
    public function categoryUpdate($id)
    {
        $updated_category = Category::where('id', $id)->update(['title' => $this->input('title')]); 
        $result = Category::where('user_id',Auth::id())->get();
        return $result;
    }

}