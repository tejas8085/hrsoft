<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SyncEmployeeUsers extends Command
{
    protected $signature = 'employees:sync-users';
    protected $description = 'Create user accounts for existing employees if not present';

    public function handle()
    {
        $employees = Employee::all();
        $createdCount = 0;

        foreach ($employees as $employee) {
            // Check if a user already exists with this email
            if (!User::where('email', $employee->email)->exists()) {
                $firstName = Str::before($employee->name, ' ');
                User::create([
                    'name' => $employee->name,
                    'email' => $employee->email,
                    'password' => Hash::make(Str::lower($firstName)),
                    'role' => 'employee',
                ]);
                $createdCount++;
                $this->info("User created for: {$employee->email}");
            }
        }

        $this->info("✅ Done. Total new users created: {$createdCount}");
    }
}
