<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name_ar' => 'محمود عبداللطيف', 
            'name_en'=> 'mahmoudhodalm',
            'email' => 'hodamedocrv@gmail.com',
            'password' => Hash::make('14112009'),
            'roles_name' => ["owner"],
        ]);
  
        $role = Role::create(['name_en' => 'owner','name_ar'=>"المالك"]);
   
        $permissions = Permission::pluck('id')->all();
  
        $role->syncPermissions($permissions);
   
        $user->assignRole($role); // Pass the role object directly
    } 
}
