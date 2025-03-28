<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:create {name} {username} {email} {password} {--admin}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = User::create([
            'name' => $this->argument('name'),
            'username' => $this->argument('username'),
            'email' => $this->argument('email'),
            'password' => Hash::make($this->argument('password')),
            'is_admin' => $this->option('admin'),
            'email_verified' => true,
        ]);

        $this->info("User {$user->name} created successfully!");

        return Command::SUCCESS;
    }
}