<?php

namespace App\Observers;

use App\Door;
use App\Notifications\QA_EmailNotification;
use Illuminate\Support\Facades\Notification;

class DoorCrudActionObserver
{

    public function created(Door $model)
    {
        $emails = ["gkaramgk94@gmail.com"];
        $data = [
            "action" => "Created",
            "crud_name" => "Doors"
        ];

        $users = \App\User::where("email", $emails)->get();
        Notification::send($users, new QA_EmailNotification($data));

    }

    public function updated(Door $model)
    {
        $emails = ["gkaramgk94@gmail.com"];
        $data = [
            "action" => "Updated",
            "crud_name" => "Doors"
        ];
        $users = \App\User::where("email", $emails)->get();
        
        Notification::send($users, new QA_EmailNotification($data));
    }

    public function deleting(Door $model)
    {
        $emails = ["gkaramgk94@gmail.com"];
        $data = [
            "action" => "Deleted",
            "crud_name" => "Doors"
        ];
        $users = \App\User::where("email", $emails)->get();
        Notification::send($users, new QA_EmailNotification($data));
    }

}