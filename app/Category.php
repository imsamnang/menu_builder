<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	public function products()
	{
	    return $this->belongsToMany('Product');
	}

	public function seo()
	{
	    return $this->morphMany('Seo', 'seoble');
	}

	public function childs()
	{
		return $this->hasMany('App\SubCategories','category_id','id') ;
	}
}
