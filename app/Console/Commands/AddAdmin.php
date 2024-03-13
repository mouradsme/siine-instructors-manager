<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class AddAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add an admin';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->ask('Enter the admin name:');
        $email = $this->ask('Enter the admin email:');
        $password = $this->secret('Enter the admin password:');

        // Create the admin user
        $admin = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'is_admin' => true, // Assuming you have an 'is_admin' column in your users table
        ]);

        $this->info('Admin created successfully.');
    }
}
