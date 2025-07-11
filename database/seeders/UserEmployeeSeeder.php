<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class UserEmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $employees = [
            [
                'name' => 'Jathar Yogesh Ramesh',
                'email' => 'yogesh67jathar@gmail.com',
                'mobile' => '7057979328',
                'password' => 'yogesh',
                'role' => 'staff'
            ],
            [
                'name' => 'Shivani Dhande',
                'email' => 'dhandeshivani724@gmail.com',
                'mobile' => '8484827844',
                'password' => 'shivani',
                'role' => 'staff'
            ],
            [
                'name' => 'Gapat Gautam Parmeshwar',
                'email' => 'gautamgapat98@gmail.com',
                'mobile' => '8766783029',
                'password' => 'gautam',
                'role' => 'staff'
            ],
            [
                'name' => 'More Shweta Annasaheb',
                'email' => 'moreshweta070@gmail.com',
                'mobile' => '9767574334',
                'password' => 'shweta',
                'role' => 'staff'
            ],
            [
                'name' => 'INAYAT Khan',
                'email' => 'KHAN.INAYAT@GMIL.COM',
                'mobile' => '9422320600',
                'password' => 'inayat',
                'role' => 'hr'
            ],
        ];

        foreach ($employees as $emp) {
            $employee = Employee::create([
                'name' => $emp['name'],
                'email' => $emp['email'],
                'mobile' => $emp['mobile'],
                // Add other fields if needed
            ]);

            User::create([
                'employee_id' => $employee->id,
                'name' => $emp['name'],
                'email' => $emp['email'],
                'password' => Hash::make($emp['password']),
                'role' => $emp['role'],
            ]);
        }
    }
}
