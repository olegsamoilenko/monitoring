<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Viber\Viber;
use App\Models\User;
use App\Notifications\UserRegistered;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
  /**
   * Display the registration view.
   *
   * @return \Illuminate\View\View
   */
  public function create()
  {
    return view('auth.register');
  }

  /**
   * Handle an incoming registration request.
   *
   * @param \App\Http\Requests\Auth\RegisterRequest $request
   * @return \Illuminate\Http\RedirectResponse
   *
   * @throws \Illuminate\Validation\ValidationException
   */
  public function store(RegisterRequest $request)
  {
    $data = $request->validated();

    $data['password'] = Hash::make($data['password']);

    $user = User::create(
      $data
      );

    $user->notify((new UserRegistered($user))->afterCommit());

//    event(new Registered($user));
//
//    Auth::login($user);

    return redirect('/confirm-register');
  }

  /**
   * View registration confirmation pages
   *
   * @return \Illuminate\View\View
   */
  public function confirmation()
  {
    return view('auth.confirm-register');
  }
}
