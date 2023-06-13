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
        $loremIpsum = "Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua";
        $words = explode(" ", $loremIpsum);
       

        $users = User::role('customer')->get();

        // Generate 20 issues
        for ($i = 0; $i < 20; $i++) {
            $status = $statuses[array_rand($statuses)];
            $user = $users->random();
            $subject = ucfirst($words[array_rand($words)].' Issue '.$i) ;
            $details = 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quas eaque porro reprehenderit facere vitae itaque cum, labore odit magni officiis eum. Officiis eius nobis iusto adipisci minima sit obcaecati eveniet.' . ($i + 1);

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
