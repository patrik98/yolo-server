<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::query()
            ->where('email', '=', 'test1@test.com')
            ->first();

        if (!$user) {
            $user = new User();
            $user->name = "test user 1";
            $user->email = "test1@test.com";
            $user->email_verified_at = now();
            $user->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
            $user->save();
        }

        for ($i = 0; $i < 5; $i++) {
            /* @var $project Project */
            $project = Project::factory()->make();
            $project->save();
            $project->users()->attach($user);
        }

    }
}
