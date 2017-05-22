<?php

namespace App\Observers;

use App\Stautus;
use App\Notifications\QA_EmailNotification;
use Illuminate\Support\Facades\Notification;

class StautusCrudActionObserver
{

    public function created(Stautus $model)
    {
        $emails = ["admin@admin.com"];
        $data = [
            "action" => "Created",
            "crud_name" => "Stautuss"
        ];

        $users = \App\User::where("email", $emails)->get();
        Notification::send($users, new QA_EmailNotification($data));

    }

    

    public function deleting(Stautus $model)
    {
        $emails = ["admin@admin.com"];
        $data = [
            "action" => "Deleted",
            "crud_name" => "Stautuss"
        ];
        $users = \App\User::where("email", $emails)->get();
        Notification::send($users, new QA_EmailNotification($data));
    }

}