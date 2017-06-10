<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubComment extends Model
{
	protected $table="sub_comments";
	
    public function comment()
    {
    	return $this->belongsTo('App\Comment');
    }
}
