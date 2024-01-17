<?php

namespace App\Listeners;

use App\Helper\Helper;
use App\LogHistory;
use App\Monitoring;
use App\Notifications\UserLoggedInNotification;
use App\NotifierList;
use illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class LoginListener
{

    public $user;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $user = auth()->user();
        $mon_config = Monitoring::first();

        if($mon_config && $mon_config->monitor_logged_in_user){
            //add log history
            $loghistory = new LogHistory();
            $loghistory->user_id = auth()->user()->id;
            $loghistory->table_name = "Users";
            $loghistory->action = "User LoggedIn";
            $loghistory->save();
            if($mon_config->logged_in_monitoring_level == 2 || $mon_config->logged_in_monitoring_level == 0){
                $notifiers = NotifierList::pluck('email');

                Notification::route('mail',$notifiers)->notify(new UserLoggedInNotification($user));
            }
            //send sms
            if($mon_config->logged_in_monitoring_level == 2 || $mon_config->logged_in_monitoring_level == 1){
                $message = "A User has loggedIn . Name: $user->name, Email: $user->email, Phone: $user->phone";
                $notifiersPhone = NotifierList::pluck("phone");
                foreach($notifiersPhone as $phone) {
                    Helper::sendSms($phone,$message);
                }
            }
        }
    }
}
