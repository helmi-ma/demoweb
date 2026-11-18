<?php

namespace Database\Seeders;

use App\Models\Media;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Helmi',
            'email' => 'helmi@flipplay.test',
        ]);

        User::factory()->create([
            'name' => 'Rudi',
            'email' => 'rudi@flipplay.test',
        ]);

        Media::create([
            'title' => 'Interstellar',
            'type' => 'Film',
            'genre' => 'Sci-Fi',
            'release_year' => 2014,
            'description' => 'Eksplorasi luar angkasa melewati lubang cacing.',
        ]);

        Media::create([
            'title' => 'Attack on Titan',
            'type' => 'Anime',
            'genre' => 'Action',
            'release_year' => 2013,
            'description' => 'Perjuangan umat manusia bertahan hidup di balik tembok.',
        ]);
    }
}
