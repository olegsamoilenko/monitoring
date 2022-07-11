<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Notifications\UserActivated;
use App\Notifications\UserDeactivated;
use App\Notifications\UserRoleChangedAdmin;
use Illuminate\Http\Request;

class UserController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
   */
  public function index()
  {
    return view('admin.users.index');
  }

  /**
   * Paginate users
   *
   * @return \Illuminate\Http\JsonResponse
   */

  public function paginationUsers(Request $request)
  {

    $users = User::
      when($request->userActivationStatus, function ($query, $userActivationStatus) {
        return $query->where('activated', $userActivationStatus);
      })
      ->when($request->userRole, function ($query, $userRole) {
        return $query->where('role', $userRole);
      })
      ->orderBy($request->userOrderBy, $request->userDirection)->paginate($request->userPerPage);

    $users->withPath('users/');
    $users->load('roles');


    return response()->json([
      'users' => $users,
    ], 201);
  }


  /**
   * Show the form for editing the specified resource.
   *
   * @param \App\Models\User  $user
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
   */
  public function edit(User $user)
  {
    $user->load('roles');
    return view('admin.users.edit', ['user' => $user]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \App\Http\Requests\UpdateUserRequest $request
   * * @param  \App\Models\User  $user
   * @return \Illuminate\Http\JsonResponse
   */
  public function update(UpdateUserRequest $request, User $user)
  {

    $userActivated = $user->activated;

    $data = $request->validated();

    $user->update($data);

    if ($request->userRoles) {
      $user->roles()->sync($request->userRoles);
    }


    if ($userActivated === 0 && $data['activated'] === 1) {
      $user->notify((new UserActivated($user))->afterCommit());
    }

    if ($userActivated === 1 && $data['activated'] === 0) {
      $user->notify((new UserDeactivated($user))->afterCommit());
    }

    if  ($request->userRoles === 2 && $userActivated === $data['activated']) {
      $user->notify((new UserRoleChangedAdmin($user))->afterCommit());
    }

    return response()->json([
      'message' => 'Користовача успішно оновлено',
      'user' => $user,
    ], 201);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param \App\Models\User $user
   * @return \Illuminate\Http\JsonResponse
   */
  public function destroy(User $user)
  {
    $user->delete();

    return response()->json([
      'message' => 'Користувача успішно видалено',
    ], 201);
  }
}
