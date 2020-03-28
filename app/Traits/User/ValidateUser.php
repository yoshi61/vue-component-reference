<?php

namespace App\Traits\User;

trait ValidateUser
{
    // validate add user
    public function validateAddUser($request){
        $rules = [
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'mobile' => 'unique:users',
            'email' => 'required|email|max:255|unique:users'
        ];
        $request->validate($rules);
    }

    public function validateGetUsers($request){
        $rules = [
            'search_term' => 'max:100|nullable',
            'current_page' => 'required|numeric',
            'display_count' => 'required|numeric',
            'sort_by' => 'array',
            'descending' => 'array',
        ];
        $request->validate($rules);
    }

    public function validateUpdateUser($request){
        $rules = [
            'username' => 'required|string|max:255',
            'password' => 'string|min:6|nullable',
            'first_name' => 'string|max:255|nullable',
            'last_name' => 'string|max:255|nullable',
            'mobile' => 'string|nullable',
            'email' => 'email|max:255|nullable'
        ];
        $request->validate($rules);
    }

}
