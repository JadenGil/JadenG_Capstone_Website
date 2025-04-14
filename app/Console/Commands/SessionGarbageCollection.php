<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SessionGarbageCollection extends Command
{
    protected $signature = 'session:gc';
    protected $description = 'Clear expired sessions from the database';

    public function handle()
    {
        $lifetime = config('session.lifetime');
        $this->info('Clearing sessions older than ' . $lifetime . ' minutes...');
        
        $count = DB::table('sessions')
            ->where('last_activity', '<', Carbon::now()->subMinutes($lifetime)->getTimestamp())
            ->delete();
            
        $this->info("Cleared {$count} expired sessions.");
        
        return Command::SUCCESS;
    }
}