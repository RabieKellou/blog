<?php

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
        if ($this->command->confirm('Do you want to refreshs the database?')) {
            $this->command->call('migrate:refresh');
            $this->command->info('database has been refreshed');
        }

        $this->call([UsersTableSeeder::class, PostsTableSeeder::class, CommentsTableSeeder::class, TagTableSeeder::class, PostTagTableSeeder::class]);
    }
}
