<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{ 
     protected $appends=['cat_name','deal_count'];
     protected $hidden=['categoryinfo','alldeal'];

    public function categoryinfo()
    {
    	return $this->belongsTo('App\Category','category');
    }

    public function getCatNameAttribute()
    {
      return $this->categoryinfo->category_name;
    }

    public function alldeal()
    {
    	return $this->hasMany('App\Deal','businessId');	
    }

     public function getDealCountAttribute()
    {
      return $this->alldeal->count();
    }
}
