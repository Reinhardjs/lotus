<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\RoleHierarchy;

class UsersAndNotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $numberOfUsers = 10;
        $numberOfNotes = 100;
        $usersIds = array();
        $statusIds = array();
        $faker = Faker::create();
        /* Create roles */
        $adminRole = Role::create(['name' => 'admin']);
        RoleHierarchy::create([
            'role_id' => $adminRole->id,
            'hierarchy' => 1,
        ]);
        $userRole = Role::create(['name' => 'user']);
        RoleHierarchy::create([
            'role_id' => $userRole->id,
            'hierarchy' => 2,
        ]);
        $guestRole = Role::create(['name' => 'guest']);
        RoleHierarchy::create([
            'role_id' => $guestRole->id,
            'hierarchy' => 3,
        ]);
        $role1 = Role::create(['name' => 'role1']);
        RoleHierarchy::create([
            'role_id' => $role1->id,
            'hierarchy' => 1,
        ]);

        // kepatuhan-internal-dan-penyuluhan
        $role2 = Role::create(['name' => 'role2']);
        RoleHierarchy::create([
            'role_id' => $role2->id,
            'hierarchy' => 1,
        ]);

        // perbendaharaan
        $role3 = Role::create(['name' => 'role3']);
        RoleHierarchy::create([
            'role_id' => $role3->id,
            'hierarchy' => 1,
        ]);

        // pelayanan-kepabeanan-dan-cukai-dan-dukungan-teknis
        $role4 = Role::create(['name' => 'role4']);
        RoleHierarchy::create([
            'role_id' => $role4->id,
            'hierarchy' => 1,
        ]);

        // subbagian umum
        $role5 = Role::create(['name' => 'role5']);
        RoleHierarchy::create([
            'role_id' => $role5->id,
            'hierarchy' => 7,
        ]);

        /*  insert status  */
        DB::table('status')->insert([
            'name' => 'ongoing',
            'class' => 'badge badge-pill badge-primary',
        ]);
        array_push($statusIds, DB::getPdo()->lastInsertId());
        DB::table('status')->insert([
            'name' => 'stopped',
            'class' => 'badge badge-pill badge-secondary',
        ]);
        array_push($statusIds, DB::getPdo()->lastInsertId());
        DB::table('status')->insert([
            'name' => 'completed',
            'class' => 'badge badge-pill badge-success',
        ]);
        array_push($statusIds, DB::getPdo()->lastInsertId());
        DB::table('status')->insert([
            'name' => 'expired',
            'class' => 'badge badge-pill badge-warning',
        ]);
        array_push($statusIds, DB::getPdo()->lastInsertId());
        /*  insert users   */
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'user,admin'
        ]);
        $user->assignRole('admin');
        $user->assignRole('user');

        $user = User::create([
            'name' => 'user1',
            'email' => 'user1@user1.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'role1, user'
        ]);
        $user->assignRole('role1');
        $user->assignRole('user');

        $user = User::create([
            'name' => 'user2',
            'email' => 'user2@user2.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'role2, user'
        ]);
        $user->assignRole('role2');
        $user->assignRole('user');

        $user = User::create([
            'name' => 'user3',
            'email' => 'user3@user3.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'role3, user'
        ]);
        $user->assignRole('role3');
        $user->assignRole('user');

        $user = User::create([
            'name' => 'user4',
            'email' => 'user4@user4.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'role4, user'
        ]);
        $user->assignRole('role4');
        $user->assignRole('user');

        $user = User::create([
            'name' => 'user5',
            'email' => 'user5@user5.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'role5, user'
        ]);
        $user->assignRole('role5');
        $user->assignRole('user');
    }
}
