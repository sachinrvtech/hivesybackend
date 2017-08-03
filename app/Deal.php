<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
	protected $appends=['image_count'];
	protected $hidden=['dealimage'];
    public function businessinfo()
    {
    	return $this->belongsTo('App\Business','businessId');
    }

     public function dealimage()
    {
    	return $this->hasMany('App\DealImage','deal_id');
    }

    public function images()
    {
    	return $this->hasMany('App\DealImage','deal_id');
    }

     public function getImageCountAttribute()
    {
    	return $this->dealimage->count();
    }

      public function hassaved()
    {
        return $this->hasMany('App\UserDeal','deal_id');
    }
}
