<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Parameter;
use App\Notifications\AplEndRelation;
use Illuminate\Console\Command;
use Carbon\Carbon;

class SendAplEndExclusiveRelationship extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:endapl';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'End Apl Exclusive Relationship';

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
        // $users->map(function($user){
            // $user->notify (new AplEndRelation());
        // });

        $nbDay = Parameter::nbDayEndApl();
        $now = Carbon::now();
        $allMember = User::hasAplActiveRelation();
        
        if(sizeof($allMember)){
            foreach ($allMember as $key => $member) {
                $date = $member->apl_ends_at;
                $diff = $date->diffInDays($now);
                $diffDayAplUser = $nbDay-$diff;

                if($diffDayAplUser===30 || $diffDayAplUser===7 || $diffDayAplUser===3){
                    $member->notify(new AplEndRelation($diffDayAplUser,$member));
                }   
            }
        }
    }
}
