<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $fillable = [
		 'title','text','cat_id','image','user_id'
	];

	protected $hidden = [];

	public function category(){
		return $this->belongsTo('App\Category', 'cat_id');
	}
}
