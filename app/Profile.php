<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
	protected $guarded = [];
    public function user() {
    	return $this->belongsTo(User::class);
    }

    public function followers() {
    	return $this->belongsToMany(User::class);
    }

    public function profileImage() {
    	$imagePath = ($this->image) ? $this->image : '/profile/MkYPHmKLuzrXZz2VMazY0TTs57WL19Cr3nqdeI3a.png';
    	return '/storage/'.$imagePath;
    }
}
