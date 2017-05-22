<?php

namespace App\Observers;

use App\Past;
use App\Notifications\QA_EmailNotification;
use Illuminate\Support\Facades\Notification;

class PastCrudActionObserver
{

    

    

    public function deleting(Past $model)
    {
        $emails = ["admin@admin.com"];
        $data = [
            "action" => "Deleted",
            "crud_name" => "Pasts"
        ];
        $users = \App\User::where("email", $emails)->get();
        Notification::send($users, new QA_EmailNotification($data));
    }

}