<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\GetTogglDataController;
use Illuminate\Support\Carbon;

class GetTogglTimeEntries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'toggl:entries{since}{until?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'togglの(全workspaceの)timeEntryデータをgetしてDBにinsertする';

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
        $since = $this->argument('since');
        $until = $this->argument('until');
        if (!Carbon::hasFormat($since, 'Y-m-d') || !Carbon::hasFormat($until, 'Y-m-d')) {
            echo '日付フォーマットは2020-10-10です';
            return;
        }
        if (!$until) {
            $until = Carbon::now()->format('Y-m-d');
        }
        $get_toggl->saveTimeEntries($since, $until);
    }
}
