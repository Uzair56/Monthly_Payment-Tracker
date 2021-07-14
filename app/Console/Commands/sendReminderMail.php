<?php

namespace App\Console\Commands;

use App\Mail\ReminderEmailPayment;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Console\Command;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class sendReminderMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Reminder Daily';

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
         $payments = Payment::where('status', 0)
        ->whereDate( 'due_date', now()->subDays(3))->with('users')
        ->get();
        $user = User::where('id',1)->first();
        Mail::to($user->email)->send(new ReminderEmailPayment($payments));
    }
}
