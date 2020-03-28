<?php

namespace App;

use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\FilterRecords;

use Auth;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, FilterRecords;

    private $request;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password', 'title', 'first_name', 'last_name', 'email', 'mobile'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->request = $attributes;
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * ---------------------------
     * USER FUNCTIONS
     * ---------------------------
     */

    // Logout user
    public static function logoutUser(){
        return self::logout();
    }

    // Create new user account
    public function createNewUser(){
        return $this->dispatchCreateNewUser();
    }

    // get a list of users
    public function getUsers(){
        return $this->fetchUsers();
    }

    // update user details
    public function updateUser(){
        return $this->dispatchUpdateUser();
    }

    /**
     * ---------------------------------------------
     * PRIVATE LOGIC & FUNCTIONS
     * ---------------------------------------------
     * Private functions and application logic listed under here
     */

    // create new user account
    private function dispatchCreateNewUser(){
        $options = $this->request;

        // hash password for security
        $options['password'] = Hash::make($options['password']);

        // create user
        $newUser = self::create($options);

        $result = $newUser;

        return $result;
    }

    // logout user
    private static function logout(){

        // check if current user is log in
        if( Auth::check() ) {

            // Generate token
            $user = Auth::user();

            // delete token
            $user->tokens->each(function ($token, $key) {
                $token->delete();
            });

            return true;
        }

        return false;
    }

    // get a list of Users
    private function fetchUsers(){
        $options = $this->request;

        //assign options to a collection
        $attributes = collect($options);

        // prepare query
        $query = self::searchUser( $attributes );

        // Escape - delete users
        $query->where('deleted_at', null);
        $query->orderResult( $attributes );

        // Record query count for pagination
        $total_rows_number = $query->count();

        // no record
        if( $total_rows_number < 1){
            return false;
        }

        // Apply pagination - DO NOT REFACTOR INTO TRAITS
        if( array_key_exists('display_count', $options) ){
            $to_skip = $this->rowsToSkip( $options['current_page'], $options['display_count'] );
            $query->skip( $to_skip )->take( $options['display_count'] );
        }

        // render result
        $result = $query->get();

        // check for error
        if( !isset($result)){
            return false;
        }

        return [
            'attributes' => [ 'total_row_count' => $total_rows_number ],
            'data' =>$result
        ];
    }

    // update - user details
    private function dispatchUpdateUser(){
        $options = $this->request;

        $user = self::find($options['id']);

        // no record
        if( empty($user) ){
            return false;
        }

        // password
        if( empty($options['password']) ){
            unset($options['password']);
        }else{
            // update password
            $options['password'] = Hash::make($options['password']);
        }


        /** username - check if empty and not already taken **/

        if( empty($options['username']) || $user->username == $options['username'] ){
            unset($options['username']);
        }
        // check if username exists
        else if( !$this->dispatchCheck('username') ){
            unset($options['username']);
        }

        /** mobile - check if empty and not already taken **/

        if( empty($options['mobile']) || $user->mobile == $options['mobile'] ){
            unset($options['mobile']);
        }
        // check if mobile exists
        else if( !$this->dispatchCheck('mobile') ){
            unset($options['mobile']);
        }

        /** email - check if empty and not already taken **/

        if( empty($options['email']) || $user->mobile == $options['email'] ){
            unset($options['email']);
        }
        // check if email exists
        else if( !$this->dispatchCheck('email') ){
            unset($options['email']);
        }

        // update user options
        $user->update($options);

        return $user;
    }

    // common validate function
    private function dispatchCheck($column){
        $options = $this->request;

        // search
        $record = self::where($column, $options[$column]);

        // check to escape current user we are check from
        if( array_key_exists('id', $options)){
            $record->where('id', '!=', $options['id']);
        }

        // check DOES NOT exists
        if( $record->count() < 1){
            return true;
        }
        // column exits
        return false;
    }
}
