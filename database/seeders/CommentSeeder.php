<?php

namespace Database\Seeders;

use App\Models\Comment;
use Database\Seeders\Traits\ToggleForeignChecks;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{

    use TruncateTable, ToggleForeignChecks;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->disableCheck();
        $this->truncate('comments');
        Comment::factory(3)->create();
        $this->enableCheck();
    }
}
