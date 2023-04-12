<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Issue;

class Issues extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
 
        $statuses = ['Submitted', 'In Progress', 'Resolved', 'Closed'];
 
 
        $users = User::role('customer')->get();
 
        // Generate 20 issues
        for ($i = 0; $i < 20; $i++) {
            $status = $statuses[array_rand($statuses)];
            $user = $users->random();
            $admins = 
            $subject = 'Issue ' . ($i + 1);
            $details = 'Details for issue ' . ($i + 1);

            Issue::create([
                'user_id' => $user->id,
                'admin_id' => User::role('admin')->firstOrFail()->id,
                'status' => $status,
                'subject' => $subject,
                'details' => $details,
            ]);
        }
    }
}
