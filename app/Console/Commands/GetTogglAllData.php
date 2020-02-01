<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;


class GetTogglAllData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'toggl:all{since}{until?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'togglの全データをgetしてDBにinsertする';

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
        $since = $this->argument('since');
        $until = $this->argument('until');
        // TODO:workspaceが無いと、他のAPIでgetができないので、処理が終わったか判定しないとならない。
        // TODO:foreign keyも加味して、clientsの後にprojectsをgetしないと、DBのエラーが出る。
        $this->call('toggl:workspaces');
        $this->call('toggl:users');
        $this->call('toggl:clients');
        $this->call('toggl:projects');
        $this->call('toggl:tags');
        $this->call('toggl:tasks');
        $this->call('toggl:entries', ['since' => $since, 'until' => $until ?? null]);
    }
}
