<?php

namespace App\Http\Controllers\Api\V1;

use App\Door;
use App\Past;
use App\Role;
use App\Support;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class DataController extends Controller
{
    //

    public function allData($token = null, $door_key = null)
    {

        $data = [
            "schedule" => [

                'groups' => [
                    [
                        "date" => "9:00 am",
                        "sessions" => [
                            [
                                "name" => "Breakfast",
                                "timeStart" => "8:00 am",
                                "timeEnd" => "9:00 am",
                                "location" => "Main hallway",
                                "tracks" => [
                                    "Food"
                                ]
                            ],
                            [

                                "name" => "Getting started with Ionics",
                                "location" => "Room 2202",
                                "description" => "Mobile devices and browsers are now advanced enough that developers can build native-quality mobile apps using open web technologies like HTML5, Javascript, and CSS. In this talk, we’ll provide background on why and how we created Ionic, the design decisions made as we integrated Ionic with Angular, and the performance considerations for mobile platforms that our team had to overcome. We’ll also review new and upcoming Ionic features, and talk about the hidden powers and benefits of combining mobile app development and Angular.",
                                "speakerNames" => [
                                    "Ted Turtle"
                                ],
                                "timeStart" => "9:30 am",
                                "timeEnd" => "9:45 am",
                                "tracks" => [
                                    "Ionic"
                                ]
                            ]
                        ]
                    ],
                    [
                        "date" => "8:00 am",
                        "sessions" => [
                            [
                                "name" => "Breakfastsss",
                                "timeStart" => "8:00 am",
                                "timeEnd" => "9:00 am",
                                "location" => "Main hallway",
                                "tracks" => [
                                    "Food"
                                ]
                            ],
                            [

                                "name" => "Getting started with Ionicssss",
                                "location" => "Room 2202",
                                "description" => "Mobile devices and browsers are now advanced enough that developers can build native-quality mobile apps using open web technologies like HTML5, Javascript, and CSS. In this talk, we’ll provide background on why and how we created Ionic, the design decisions made as we integrated Ionic with Angular, and the performance considerations for mobile platforms that our team had to overcome. We’ll also review new and upcoming Ionic features, and talk about the hidden powers and benefits of combining mobile app development and Angular.",
                                "speakerNames" => [
                                    "Ted Turtle"
                                ],
                                "timeStart" => "9:30 am",
                                "timeEnd" => "9:45 am",
                                "tracks" => [
                                    "Ionic"
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            "users" => [
                [
                    "name" => "Burt Bear",
                    "profilePic" => "assets/img/speakers/bear.jpg",
                    "twitter" => "ionicframework",
                    "about" => "Burt is a Bear.",
                    "location" => "Everywhere",
                    "email" => "burt@example.com",
                    "phone" => "+1-541-754-3010"
                ],
                [
                    "name" => "Burt Bear",
                    "profilePic" => "assets/img/speakers/bear.jpg",
                    "twitter" => "ionicframework",
                    "about" => "Burt is a Bear.",
                    "location" => "Everywhere",
                    "email" => "burt@example.com",
                    "phone" => "+1-541-754-3010"
                ],
                [
                    "name" => "Burt Bear",
                    "profilePic" => "assets/img/speakers/bear.jpg",
                    "twitter" => "ionicframework",
                    "about" => "Burt is a Bear.",
                    "location" => "Everywhere",
                    "email" => "burt@example.com",
                    "phone" => "+1-541-754-3010"
                ]
            ],
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

        $response = [
            'success' => true,
            'data' => $data,
            'error' => [
                'code' => 202
            ]
        ];

        return response()->json($response);
//        return response()->json($data);


    }

    public function allDatas(Request $request)
    {

    }

    public function allDatasPost(Request $request)
    {
        $token = $request->get('api_token');
        $door_key = $request->get('door_key');

        if (!isset($token) || !isset($door_key)) {
            $response = [
                'success' => false,
                'error' => 302,
            ];
            return response()->json($response, 404);
        } else {

            $user = User::where('api_token', '=', $token)->get()->first();
            if ($user) {
                $door_id = $user;
                return $door_id;

            } else {
                return response()->json([], 204);
            }


        }


    }

    public function scheduleData(Request $request)
    {
        $token = $request->get('api_token');
        $door_key = $request->get('door_key');

        if (!isset($token) || !isset($door_key)) {
            return 2;
        }


        $door = Door::where('door_key', '=', $door_key)->get()->first();

        $door_key = $door->id;
        $usersAll = User::where('door_key_id', $door_key)->get()->all();

        $pasts = Past::where('door_id', '=', $door_key)->orderBy('id', 'desc')->get()->all();

        $groups = [];
        foreach ($pasts as $past) {
            $groups[] = [
                "date" => Carbon::parse($past->created_at)->diffForHumans(),
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


        $response = [
            'success' => true,
            'data' => $datas,
            'error' => [
                'code' => 202
            ]
        ];
        return response()->json($response);

    }

    public function userData(Request $request)
    {
        $token = $request->get('api_token');
        $door_key = $request->get('door_key');

        if (!isset($token) || !isset($door_key)) {
            $response = [
                'success' => false,
                'error' => 302,
            ];
            return response()->json($response, 404);
        } else {

            $user = User::where('api_token', '=', $token)->get()->first();
            if ($user) {
                $door_id = $user->door_key_id;

                $door_key_compare = Door::findOrFail($door_id)->door_key;
                if ($door_key_compare == $door_key) {

                    return 44;
                }

            } else {
                return response()->json([], 204);
            }


        }

        $data = [


        ];

        $response = [
            'success' => true,
            'data' => $data,
            'error' => [
                'code' => 202
            ]
        ];
        return response()->json($response);

    }

    public function opendoor()
    {
        $door = \App\Door::where('door_key', '=', '58a6b07b12bd4d9aaf29d1b5d1eddb8e')->get()->first();;


        $status = \App\Stautus::where('door_id', '=', $door->id)->get()->first();
        $array = [

            "id" => $status->id,
            "status" => $status->status,
            "action_open" => $status->action_open,
            "action_black" => $status->action_black,
            "action_wait" => $status->action_wait,
            "action_else" => $status->action_else,
            "door_id" => $status->door_id,
            "created_at" => $status->created_at,
            "updated_at" => $status->updated_at,
            "deleted_at" => $status->deleted_at,
            "action" => $status->action

        ];
        $status->status = false;
        $status->save();
        return response()->json($array);


    }

    public function opendoorByToken($door_key, $id)
    {
        $door = \App\Door::where('door_key', '=', $door_key)->get()->first();

        $status = \App\Stautus::where('door_id', '=', $door->id)->get()->first();

        if ($id == 0) {
            $status->action = false;
        } else {
            $status->action = true;
        }
        $status->save();
        return $status;
    }

    public function updateStatus($door_key)
    {
        $door = \App\Door::where('door_key', '=', $door_key)->get()->first();


        $status = \App\Stautus::where('door_id', '=', $door->id)->get()->first();
        $status->action = false;
        $status->save();
    }

    public function updateStatusRasp($door_key, $door_action, $door_visitor)
    {
        $door = \App\Door::where('door_key', '=', $door_key)->get()->first();

        if ($door_action == "unlocked") {
            $door_action = true;
        } else {
            $door_action = false;
        }
        $intruder = true;
        if ($door_visitor != "intruder") {
            $intruder = false;
        }

        $status = \App\Past::create([
            'action' => $door_action,
            'door_id' => $door->id,
            'name' => $door_visitor,
            'intruder' => $intruder

        ]);
        return $status;

    }

    public function support(Request $request)
    {

        $door_key = $request->get('door_key');
        $message = $request->get('message');

        if ($door_key) {
            $door = Door::where('door_key', '=', $door_key)->get()->first();
            $user = User::where('door_id', '=', $door->id)->get()->first();
            if ($door) {
                $door_id = $door->id;

                $supoort = Support::create([
                    'door_id' => $door_id,
                    'message' => $message,
                    'email' => $user->email

                ]);
            } else {
                return Response::json(array(
                    'code' => 401,
                    'message' => "Wrong Door Key"
                ), 401);
            }
        } else {
            $supoort = Support::create([
                'message' => $message,
                'email' => "Unknown"

            ]);
        }
    }

    public function notification(){


        $optionBuiler = new OptionsBuilder();
        $optionBuiler->setTimeToLive(60*20);

        $notificationBuilder = new PayloadNotificationBuilder('my title');
        $notificationBuilder->setBody('Hello world')
            ->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['a_data' => 'my_data']);

        $option = $optionBuiler->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        $token = "a_registration_from_your_database";

        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);

        $downstreamResponse->numberSuccess();
        $downstreamResponse->numberFailure();
        $downstreamResponse->numberModification();

//return Array - you must remove all this tokens in your database
        $downstreamResponse->tokensToDelete();

//return Array (key : oldToken, value : new token - you must change the token in your database )
        $downstreamResponse->tokensToModify();

//return Array - you should try to resend the message to the tokens in the array
        $downstreamResponse->tokensToRetry();

    }
}
