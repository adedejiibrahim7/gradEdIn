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
        // $this->call(UserSeeder::class);
        DB::table('users')->insert([
          0 =>  [
//            'name' => "Admin",
            'email' => "testa@mailnator.com",
            'password' => bcrypt('password'),
            'is_admin' => true,
              'created_at' => date("Y-m-d H:i:s"),
              'updated_at' => date("Y-m-d H:i:s")
//            'phone'=>'+911234567890',

        ],
           1 => [
//            'name' => "Admin",
                'email' => "test2@mailnator.com",
                'password' => bcrypt('password'),
                'is_admin' => true,
               'created_at' => date("Y-m-d H:i:s"),
               'updated_at' => date("Y-m-d H:i:s")
//            'phone'=>'+911234567890',

            ]
        ]);

        DB::table('skills')->insert([
           0 => [ 'skill' => 'Research'],
            1 => [ 'skill' => 'Data Analysis'],
           2 => [ 'skill' => 'Machine Learning (Python)']
         ]);

        DB::table('profiles')->insert([
            0 => [
                'user_id' => 1,
                'title' => 'Dr',
                'avatar' => 'uploads/profile/image/sQE03pqv0ps8syfCmw6wPR2nZhN8sIwYQjApSfBY',
                'first_name' => 'Helen',
                'last_name' => 'Callagher',
                'bio' => 'Lorem ipsum dolor',
                'cv' => 'uploads/profile/docs/82nkD5BUJs73ptOxgjQ4PPyHYBnNG7OrOvi3f0SF.pdf',
                'cover_letter' => 'uploads/profile/docs/82nkD5BUJs73ptOxgjQ4PPyHYBnNG7OrOvi3f0SF.pdf',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            1 => [
                'user_id' => 2,
                'title' => 'Prof',
                'avatar' => 'uploads/profile/image/sQE03pqv0ps8syfCmw6wPR2nZhN8sIwYQjApSfBY',
                'first_name' => 'Adam',
                'last_name' => 'Lallana',
                'bio' => 'Lorem ipsum dolor',
                'cv' => 'uploads/profile/docs/82nkD5BUJs73ptOxgjQ4PPyHYBnNG7OrOvi3f0SF.pdf',
                'cover_letter' => 'uploads/profile/docs/82nkD5BUJs73ptOxgjQ4PPyHYBnNG7OrOvi3f0SF.pdf',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]
        ]);

        DB::table('profile_skills')->insert([
            0 => [
                'profile_id' => 1,
                'skills_id' => 2
            ],
            1 => [
                'profile_id' => 1,
                'skills_id' => 3
            ],
            2=>[
                'profile_id' => 2,
                'skills_id' => 1
            ]

        ]);
    }
}
