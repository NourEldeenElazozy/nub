<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // إنشاء مجموعة من المستخدمين
        DB::table('admins')->insert([
            ['name' => 'John Doe', 'email' => 'johndoe@example.com', 'password' => Hash::make('password123')],
            // ... أضف المزيد من المستخدمين حسب الحاجة
        ]);
    }
}
