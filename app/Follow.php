<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    //
    protected $fillable = [
    'follow_id', 'follower_id'
  ];

  public function getFollowCount($user_id)
  {
      return $this->where('follow_id',  '<>', $user_id)->count();
  }

  public function getFollowerCount($user_id)
  {
      return $this->where('follower_id',  '<>', $user_id)->count();
  }
}
