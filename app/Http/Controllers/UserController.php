<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Traits\ApiResponser;
use App\Traits\User\Messages;
use App\Traits\User\ValidateUser;

use App\User;

class UserController extends Controller
{
    use ValidateUser, ApiResponser, Messages;

    public function getUsers(Request $request)
    {
        $this->validateGetUsers($request);

        // fetch users
        $user = new User($request->all());
        $get_result = $user->getUsers();

        // check for errors
        if( empty($get_result) ){
            return $this->emptyResponse();
        }
        return $this->successRes( $get_result['data'], $get_result['attributes']);
    }

    public function getUserDetails($id)
    {
        $get_result = User::find($id);

        // check for errors
        if( empty($get_result) ){
            return $this->emptyResponse();
        }

        return $this->successRes( $get_result->toArray());

    }

    // Update - user
    public function updateUser(Request $request, $id){
        $this->validateUpdateUser($request);

        $user = new User( $request->all() );
        $get_result = $user->updateUser();

        // check for errors
        if( empty($get_result) ){
            return $this->notFoundResponse();
        }

        return $this->successRes($get_result);
    }
}
