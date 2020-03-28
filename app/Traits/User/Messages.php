<?php

namespace App\Traits\User;

trait Messages
{
    // Create -user error
    public function createUserErrorMessage(){
        return 'Error creating user! Please try again later.';
    }
}
