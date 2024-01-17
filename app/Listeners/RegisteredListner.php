<?php

namespace App\Listeners;

use App\Monitoring;
use App\Notifications\UserRegisteredNotification;
use App\NotifierList;
use App\Settings;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Notification;
use App\Helper\Helper;

class RegisteredListner
{
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //check if monitoring is on for this event
        $mon_config = Monitoring::first();
        if($mon_config->monitor_new_user){
            if($mon_config->new_user_monitoring_level == 2 || $mon_config->new_user_monitoring_level == 0){
                $user = $event->user;
                $notifiers = NotifierList::pluck('email');
                Notification::route('mail',$notifiers)->notify(new UserRegisteredNotification($user));
            }
            //send sms
            if($mon_config->new_user_monitoring_level == 2 || $mon_config->new_user_monitoring_level == 1){
                $user = $event->user;
                $message = "A User has been registered. Name: $user->name, Email: $user->email, Phone: $user->phone";
                $notifiersPhone = NotifierList::pluck("phone");
                foreach($notifiersPhone as $phone) {
                    Helper::sendSms($phone,$message);
                }
            }
        }
    }
}
