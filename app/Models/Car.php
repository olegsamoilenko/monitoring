<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'post',
    'direction',
    'address',
    'number',
    'type',
    'brand',
    'model',
    'color',
    'comment',
    'user_id',
  ];

  /**
   * The cars that belong to the user.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */

  public function user()
  {
    return $this->belongsTo(User::class);
  }


}
