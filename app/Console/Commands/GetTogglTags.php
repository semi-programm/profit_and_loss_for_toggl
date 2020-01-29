<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\GetTogglDataController;

class GetTogglTags extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'toggl:tags';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'togglの(全workspaceの)tagsデータをgetしてDBにinsertする';

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
     * @return mixed
     */
    public function handle()
    {
        $get_toggl = new GetTogglDataController;
        $get_toggl->saveTags();
    }
}
