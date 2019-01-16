<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\User;

class Role extends Model
{
    //
   	protected $table = 'roles';
   	use Notifiable;

	public function users()
    {
      return $this->belongsToMany(User::class);
    }
    
}
