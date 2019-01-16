<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Role;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

     public function roles()
    {
      return $this->belongsToMany(Role::class);
    }

    /**
    * @param string|array $roles
    */
    public function authorizeRoles($roles)
    {
      if (is_array($roles)) {
          return $this->hasAnyRole($roles) || 
                 abort(503, 'This action is unauthorized.111');
      }
      return $this->hasRole($roles) || 
             abort(401, 'This action is unauthorized.');
    }
    
    /**
    * Check multiple roles
    * @param array $roles
    */
    public function hasAnyRole($roles)
    {  
      return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    /**
    * Check one role
    * @param string $role
    */
    public function hasRole($role)
    {
      return null !== $this->roles()->where('name', $role)->first();
    }

    /**
    * get role name by role id
    * @param array
    */
/*    public function getRoleName()
    {
        $roleId = $this->roles()->first()['pivot']['role_id'];
        if(empty($roleId)){
            return [];
        }
        return \DB::table('roles')->select('name')->where('id',$roleId)->get();
    }*/

    /**
    * get role name by role id
    * @param string
    */
    public function getRoleName()
    {   
        $roleId = $this->roles()->first()['pivot']['role_id'];
        if(empty($roleId)){
            return "";
        }
        $nameArr = \DB::table('roles')->select('name')->where('id',$roleId)->first();
        return !empty($nameArr) ? $nameArr->name : "";
    }

}
