<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
	protected $table = 'seo';

    public function seoble()
    {
        return $this->morphTo();
    }

    public function updateFromInput()
    {
    	$this->title 	 	= e(Input::get('title'));
    	$this->description 	= e(Input::get('description'));
    	$this->keywords  	= e(Input::get('keywords'));
    	$this->save();
    	return true;
    }
}
