<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;
// password hash
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

use App\Traits\User\ValidateUser;
use App\Traits\User\Messages;
use App\Traits\ApiResponser;

class AuthController extends Controller
{

    use ValidateUser, ApiResponser, Messages;

    public function login(Request $request)
    {
        $http = new \GuzzleHttp\Client;
        try {
            $response = $http->post(config('services.passport.login_endpoint'), [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => config('services.passport.client_id'),
                    'client_secret' => config('services.passport.client_secret'),
                    'username' => $request->username,
                    'password' => $request->password,
                ]
            ]);
            return $response->getBody();
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            if ($e->getCode() === 400) {
                return response()->json('Invalid Request. Please enter a username or a password.', $e->getCode());
            } else if ($e->getCode() === 401) {
                return response()->json('Your credentials are incorrect. Please try again', $e->getCode());
            }
            return response()->json('Something went wrong on the server.', $e->getCode());
        }
    }


    public function register(Request $request)
    {
        $this->validateAddUser($request);

        $user = new User($request->all());
        $result = $user->createNewUser();

        if( empty($result)){
            return $this->errorResponse($this->createUserErrorMessage(), Response::HTTP_BAD_REQUEST);
        }

        return $this->createdResponse($result);
    }


    public function logout()
    {
        // perform request
        $result = User::logoutUser();

        if( !$result ){
            return response()->json( ['error'=>'An error occurred while logging user out!'],  Response::HTTP_BAD_REQUEST);
        }

        return $this->success('Logout was successful');
    }
}
