<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Comment;
use Carbon\Carbon;

class CleanupRejectedComments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'comments:cleanup-rejected';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete rejected comments older than 30 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting cleanup of old rejected comments...');

        // Delete rejected comments older than 30 days
        $thirtyDaysAgo = Carbon::now()->subDays(30);
        
        $deletedCount = Comment::where('is_approved', false)
            ->whereNotNull('rejected_at')
            ->where('rejected_at', '<', $thirtyDaysAgo)
            ->delete();

        $this->info("Deleted {$deletedCount} rejected comments older than 30 days.");
        $this->line('Cleanup completed successfully!');

        return Command::SUCCESS;
    }
}

