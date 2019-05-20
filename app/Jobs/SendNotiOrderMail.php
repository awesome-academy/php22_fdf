<?php

namespace App\Jobs;

use App\Models\Transaction;
use App\Models\User;
use App\Mail\NotificationOrderMail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;

class SendNotiOrderMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $transaction;
    public $admin;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Transaction $transaction, User $admin)
    {
        $this->transaction = $transaction;
        $this->admin = $admin;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new NotificationOrderMail( $this->transaction);
        Mail::to($this->admin->email)->send($email);
    }
}
