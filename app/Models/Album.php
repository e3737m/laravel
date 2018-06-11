<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\User;

class Album extends Model{
	
	protected $table = "albums";
	protected $primaryKey = "id";
	protected $fillable = ['album_name', 'album_thumb', 'description', 'user_id'];
	
	public function getPathAttribute()
	{
		 $url = $this->album_thumb;
		if(stristr($this->album_thumb, "http")===false)
		{
		  $url = 'storage/'.$this->album_thumb."/";
		}
		return $url;
	}
	
   public function photos()
   {
	   return $this->hasMany(Photo::class, 'album_id', 'id');
   }

   public function user()
   {
       return $this->belongsTo(User::class);
   }

   public function categories()
   {
       //nometabella01_nometabella02 ----> album_album_category
       return $this->belongsToMany(AlbumCategory::class, 'album_category', 'album_id', 'category_id')->withTimestamps();
   }
}
