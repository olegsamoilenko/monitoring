<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $this->call([
        DailySummarySeeder::class,
      ]);

      $role = new Role();
      $role->name = 'Користувач';
      $role->slug = 'user';
      $role->save();

      $role = new Role();
      $role->name = 'Адміністратор';
      $role->slug = 'admin';
      $role->save();

      $role = new Role();
      $role->name = 'Контррозвідка';
      $role->slug = 'counterIntelligence';
      $role->save();

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
