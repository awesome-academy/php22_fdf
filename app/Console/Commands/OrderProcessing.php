<?php

namespace App\Console\Commands;

use App\Models\Transaction;
use App\Models\User;
use App\Notifications\OrderProcessingNotification;
use Illuminate\Console\Command;
use Notification;

class OrderProcessing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'noti:orderprocessing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify pending orders';

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
        $transactions = Transaction::where('status', config('setting.default_value_0'))->get();
        $admins = User::where('is_admin', true)->get();
        if ($transactions->count() > config('setting.default_value_0')){
            foreach( $admins as $admin ) {
                if( Notification::send($admin, new OrderProcessingNotification())){

                    return back();
                }
            }
        }
    }
}
