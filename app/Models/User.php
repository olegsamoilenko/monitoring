<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'name',
    'surname',
    'phone',
    'email',
    'password',
    'role',
    'activated',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];


  /**
   * The user that has many car.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */


  public function cars()
  {
    return $this->hasMany(Car::class);
  }

  /**
   * The user that belong to many roles.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */

  public function roles()
  {
    return $this->belongsToMany(Role::class, 'roles_users');
  }

  /**
   * @param mixed ...$roles
   * @return bool
   */
  public function hasRole(... $roles ) {
    foreach ($roles as $role) {
      if ($this->roles->contains('slug', $role)) {
        return true;
      }
    }
    return false;
  }

}
