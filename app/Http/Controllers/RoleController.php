<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
  /**
   * Get posts.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function getRoles()
  {
    $roles = Role::all();

    return response()->json([
      'roles' => $roles
    ], 201);
  }
}
