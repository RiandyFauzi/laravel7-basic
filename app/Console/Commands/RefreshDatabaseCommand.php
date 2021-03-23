<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RefreshDatabaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refresh:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'refresh db dan seeded';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $this->call('migrate:refresh');

        $categories = collect(['Framework', 'Code']);
        $categories->each(function ($c) {

            \App\Category::create([
                'name' => $c,
                'slug' => \Str::slug($c),
            ]);
        });

        $tags = collect(['Laravel', 'PHP', 'Javascript']);
        $tags->each(function ($c) {

            \App\Tag::create([
                'name' => $c,
                'slug' => \Str::slug($c),
            ]);
        });


        \App\User::create([
            'name' => 'Riandy Fauzi',
            'username' => 'riandyfauzi',
            'password' => 'aaaaaaaa',
            'email' => 'riand480@gmail.com',
        ]);
        $this->info('Ges di refresh database jeng di seeded');
    }
}
