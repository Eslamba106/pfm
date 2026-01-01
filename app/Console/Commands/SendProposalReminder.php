<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Proposal;
use App\Models\BusinessSetting;
use Illuminate\Console\Command;
use App\Mail\ProposalReminderMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendProposalReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-proposal-reminder';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';


    /**
     * Execute the console command.
     */
  
    public function handle()
    {
        $proposal_expire_date_count =  optional((new BusinessSetting())->setConnection('tenant')->whereType('proposal_expire_date')->first())->value;
        $proposals = (new Proposal())->setConnection('tenant')->where('status' , 'pending')
        ->whereDate('created_at', '<=', Carbon::now()->subDays($proposal_expire_date_count))
        ->select('id','email1')->get();
    
        foreach ($proposals as $proposal) { 
            if ($proposal->email1) {
                Mail::to($proposal->email1)->send(new ProposalReminderMail($proposal));
            }
        } 
    }
    
}
