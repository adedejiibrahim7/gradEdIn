<?php

use Illuminate\Support\Facades;
use App\User;

function getFullName($id){
    $user = User::find($id);

  if($user->user_type == "recruiter"){
      if($user->employerprofile){
          return $user->employerprofile->first_name." ".$user->employerprofile->last_name;
      }
  }

  if($user->user_type == "seeker"){
      if($user->profile){
          return $user->profile->first_name." ".$user->profile->last_name;
      }
  }
//  return $id;
  return "User";
}
