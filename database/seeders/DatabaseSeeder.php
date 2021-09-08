<?php

namespace Database\Seeders;

use App\Models\PotentialUser;
use App\Models\User;
use App\Models\UserProfile;
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
        UserProfile::factory()->count(10)->create();
        UserProfile::factory()
            ->state(['is_admin' => true])
            ->for(User::factory()
                    ->createOne([
                        'email'=>'test@email.com'
                    ]              
                )  
            )->createOne();
        $this->call([
            PotentialUserSeeder::class,
        ]);
    }
}
