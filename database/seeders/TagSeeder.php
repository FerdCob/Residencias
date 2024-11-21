<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = ['Laravel', 'PHP', 'JavaScript', 'Vue.js', 'React.js', 'Node.js', 'Tailwind CSS', 'Alpine.js', 'Livewire', 'Inertia.js'];
        foreach ($tags as $tag) {
            \App\Models\Tag::create([
                'name' => $tag,
            ]);
        }
    }
}
