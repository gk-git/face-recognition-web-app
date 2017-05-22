<?php

namespace App\Observers;

use App\Role;
use App\Notifications\QA_EmailNotification;
use Illuminate\Support\Facades\Notification;

class RoleCrudActionObserver
{

    public function created(Role $model)
    {
        $emails = ["admin@admin.com"];
        $data = [
            "action" => "Created",
            "crud_name" => "Roles"
        ];

        $users = \App\User::where("email", $emails)->get();
        Notification::send($users, new QA_EmailNotification($data));

    }

    public function updated(Role $model)
    {
        $emails = ["admin@admin.com"];
        $data = [
            "action" => "Updated",
            "crud_name" => "Roles"
        ];
        $users = \App\User::where("email", $emails)->get();
        Notification::send($users, new QA_EmailNotification($data));
    }

    public function deleting(Role $model)
    {
        $emails = ["admin@admin.com"];
        $data = [
            "action" => "Deleted",
            "crud_name" => "Roles"
        ];
        $users = \App\User::where("email", $emails)->get();
        Notification::send($users, new QA_EmailNotification($data));
    }

}