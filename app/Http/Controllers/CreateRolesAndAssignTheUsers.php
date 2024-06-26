<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;


class CreateRolesAndAssignTheUsers extends Controller
{
    public function createRolesAndUsers(){
        $roles = ['superadmin', 'admin', 'employee'];

        foreach ($roles as $roleName) {
            // Create the role
            $role = Role::firstOrCreate(['name' => $roleName]);

            // Create a user
            $user = User::create([
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'password' => Hash::make('password'),
            ]);

            // Assign the role to the user
            $user->assignRole($role);
        }

        return redirect()->route('showUserWithRoles');



    }
    public function showUsersWithRoles()
    {
        $users = User::with('roles')->get();
        foreach ($users as $user) {
            echo "User: {$user->name} ({$user->email})<br>";
            echo "Role: {$user->roles->first()->name}<br>";
            echo "<br>";
        }
    }
}
