<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeUserAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:make-admin {email : The email of the user to promote to admin}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Promote a user to admin role';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        
        // Find the user by email
        $user = \App\Models\User::where('email', $email)->first();
        
        if (!$user) {
            $this->error("User with email {$email} not found!");
            return 1;
        }
        
        // Check if the user is already an admin
        if ($user->role === 'admin') {
            $this->info("User {$email} is already an admin!");
            return 0;
        }
        
        // Promote the user to admin
        $user->role = 'admin';
        $user->save();
        
        $this->info("User {$email} has been promoted to admin role!");
        return 0;
    }
}
