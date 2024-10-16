<?php

namespace App\Console\Commands;

use App\Mail\FollowUpReminder;
use App\Models\Lead;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendFollowUpReminders extends Command
{
    protected $signature = 'crm:send-follow-up-reminders';
    protected $description = 'Send follow-up reminders for leads';

    public function handle()
    {
        $leads = Lead::whereDate('follow_up_date', today())->get();

        foreach ($leads as $lead) {
            Mail::to($lead->customer->email)->send(new FollowUpReminder($lead));
        }

        $this->info('Follow-up reminders sent successfully.');
    }
}