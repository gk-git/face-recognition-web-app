<?php
Route::get('/', function () {
    return redirect('/home');
});

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Registration Routes...
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('auth.register');
$this->post('register', 'Auth\RegisterController@register')->name('auth.register');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

// Social login
Route::get('login/{driver}', 'Auth\LoginController@redirectToSocial')->name('auth.login.social');
Route::get('{driver}/callback', 'Auth\LoginController@handleSocialCallback')->name('auth.login.social_callback');

Route::get('/cv', function () {

    $filename = 'public/cvpdf.pdf';

    // Get the file content to put into your response
    $file = storage_path('app') . '/' . $filename;
    return response()->file($file);
});
Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index');
    Route::resource('roles', 'RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'UsersController');
    Route::post('users_mass_destroy', ['uses' => 'UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('user_actions', 'UserActionsController');
    Route::resource('doors', 'DoorsController');
    Route::post('doors_mass_destroy', ['uses' => 'DoorsController@massDestroy', 'as' => 'doors.mass_destroy']);
    Route::resource('stautuses', 'StautusesController');
    Route::post('stautuses_mass_destroy', ['uses' => 'StautusesController@massDestroy', 'as' => 'stautuses.mass_destroy']);
    Route::resource('pasts', 'PastsController');
    Route::post('pasts_mass_destroy', ['uses' => 'PastsController@massDestroy', 'as' => 'pasts.mass_destroy']);


    Route::get('opendoor/{id}', function ($id) {

        $door = \App\Door::where('door_key', '=', '58a6b07b12bd4d9aaf29d1b5d1eddb8e')->get()->first();

        $status = \App\Stautus::where('door_id', '=', $door->id)->get()->first();

        if ($id == 0) {
            $status->action = false;
        } else {
            $status->action = true;
        }
        $status->save();
        return $status;
//        $status->

    });
});
