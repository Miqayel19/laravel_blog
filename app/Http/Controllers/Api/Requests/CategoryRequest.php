<?php

namespace App\Http\Controllers\Api\Requests;

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
        $info = $this->all();
        return $info;
    }
    public function categoryUpdate()
    {
        $info = $this->all();
        return $info;
    }

}