<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

      $this->call([
        RoleSeeder::class,
        UserSeeder::class,
        PostSeeder::class,
        CarSeeder::class,
        DailySummarySeeder::class,
        DailySummaryCarSeeder::class,
      ]);

      $admin = Role::where('slug', 'admin')->first();

      $user = new User();
      $user->name = 'admin';
      $user->surname = 'admin';
      $user->phone = '050111111';
      $user->email = 'admin@admin.com';
      $user->email_verified_at = now();
      $user->password = bcrypt('password'); // password
      $user->remember_token = Str::random(10);
      $user->activated = 1;
      $user->save();
      $user->roles()->attach($admin);

    }
}
