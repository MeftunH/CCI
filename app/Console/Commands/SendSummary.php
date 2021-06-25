<?php

namespace App\Console\Commands;

use App\Actions\Subscribers\GetActiveSubscribers;
use App\Actions\Subscribers\LatestNewsAction;
use App\Mail\Summary;
use App\Models\Subscriber;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendSummary extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:summary';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send weekly email summary';

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
    public function handle(GetActiveSubscribers $getActiveSubscribers,LatestNewsAction $latestNewsAction)
    {
        $subscribers = $getActiveSubscribers->run();
        $news = $latestNewsAction->run();
        foreach ($subscribers as $subscriber) {
            Mail::to([$subscriber])->send(new Summary($subscriber,$news));
        }

    }
}
