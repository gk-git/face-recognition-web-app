<?php

namespace App\Http\Controllers\Api\V1;

use App\Past;
use App\Role;
use App\User;
use Carbon\Carbon;
use DebugBar\DebugBar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use Validator;
use App\Http\Requests;
use Hash;

class LoginController extends Controller
{
    //


    public function login(Request $request)
    {

        $email = $request->get('email');
        $password = $request->get('password');


        $users = User::where('email', '=', $email)->limit(1);
        $users_count = $users->count();

        $users = $users->get()->all();

        if ($users_count < 1) {
            return response()->json(['error' => $request->all()], 404);

        }

        $user = User::where('email', '=', $email)->first();

        $id = $user->id;
        $password_user = $user->password;


        if (Hash::check($password, $password_user)) {


            $door_key = $user->door_key->id;
            $usersAll = User::where('door_key_id', $door_key)->get()->all();

            $pasts = Past::where('door_id', '=', $door_key)->orderBy('id', 'desc')->get()->all();

            $groups = [];
            foreach ($pasts as $past) {
                $groups[] = [
                    "date" =>Carbon::parse($past->created_at)->diffForHumans(),
                    "dates" => $past->created_at,
                    "sessions" => [
                        [
                            "name" => $past->name,
                            "intruder" => $past->intruder

                        ]
                    ]
                ];

            }

            $arrays = [];
            foreach ($usersAll as $userAll) {

                $role_id = $userAll['role_id'];
                $role = Role::where('id', '=', $role_id)->first();

                $role = $role->title;

                $usersArray = [];
                $usersArray['id'] = $userAll->id;
                $usersArray['name'] = $userAll->name;
                $usersArray['email'] = $userAll->email;
                $usersArray['role'] = $role;


                $past = Past::where('user_id', '=', $userAll->id)->get()->last();
                if ($past) {
                    $usersArray['pastCondition'] = true;
//                    return $past->created_at;
                    $usersArray['past'] = Carbon::parse($past->created_at)->diffForHumans();
                    $usersArray['action'] = $past->action;


                } else {
                    $usersArray['pastCondition'] = false;
                    $usersArray['past'] = null;
                    $usersArray['action'] = null;
                }

                $arrays[] = $usersArray;


            }
            $datas = [
                "schedule" => [

                    'groups' => $groups
                ],
                "users" => $arrays,
                "map" => [
                    [
                        "name" => "AUL Kaslik University",
                        "lat" => 33.975811,
                        "lng" => 35.612084,
                        "center" => true
                    ],
                    [
                        "name" => "AUL Kaslik University",
                        "lat" => 33.975811,
                        "lng" => 35.612084,
                        "center" => true
                    ]
                ]
            ];

//            $door = User::find($id)-;
            // The passwords match...
            $response = [
                'success' => true,
                'message' => $user,
                'data' => $datas
            ];

            return response()->json($response);
        } else {
            return response()->json(['error' => 'Error msg Password is wrong'], 403);

        }
//       return
    }

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:smart_users|email',
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'username' => 'required|min:3',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Error msg'], 404);
        }

        $first_name = $request->get('first_name');
        $last_name = $request->get('last_name');
        $username = $request->get('username');
        $email = $request->get('email');

        $password = Hash::make($request->get('password'));

        $user = User::create([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'username' => $username,
            'email' => $email,
            'password' => $password,
        ]);

        return response()->json($user);
    }
}
