<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Topic;

class TopicSeeder extends Seeder
{
    public function run(): void
    {
        Topic::create([
            'title' => 'HTML',
            'description' => 'HyperText Markup Language is ...',
            'category' => 'HTML'
        ]);

        Topic::create([
            'title' => 'CSS',
            'description' => 'Cascading Style Sheets is ...',
            'category' => 'CSS'
        ]);

        Topic::create([
            'title' => 'JavaScript',
            'description' => 'JavaScript is a high-level language ...',
            'category' => 'JavaScript'
        ]);

        Topic::create([
            'title' => 'Node.js',
            'description' => 'Node.js is an open-source runtime ...',
            'category' => 'Node.js'
        ]);
    }
}
