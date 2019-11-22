<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            
            ['name' => 'Овчаренко Анатолий', 'email' => 'admin@example.com', 'password' => '$2y$10$PcEaJA7QgTo7XNZB9ejLJeOlWjR3EK1mClwmypkgi752QyC09oa6W', 'remember_token' => '',], 
            ['name' => 'Михайлов Илья', 'email' => 'user1@example.com', 'password' => '$2y$10$PcEaJA7QgTo7XNZB9ejLJeOlWjR3EK1mClwmypkgi752QyC09oa6W', 'remember_token' => '',],
            ['name' => 'Шарапов Денис', 'email' => 'user2@example.com', 'password' => '$2y$10$PcEaJA7QgTo7XNZB9ejLJeOlWjR3EK1mClwmypkgi752QyC09oa6W', 'remember_token' => '',],
            ['name' => 'Таранец Юрий', 'email' => 'user3@example.com', 'password' => '$2y$10$PcEaJA7QgTo7XNZB9ejLJeOlWjR3EK1mClwmypkgi752QyC09oa6W', 'remember_token' => '',],
            ['name' => 'Анисимов Сергей', 'email' => 'user4@example.com', 'password' => '$2y$10$PcEaJA7QgTo7XNZB9ejLJeOlWjR3EK1mClwmypkgi752QyC09oa6W', 'remember_token' => '',],
        ];

        foreach ($users as $user) {
            \App\User::create($user);
        }
    }
}
