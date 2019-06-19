<?php

class User{
    private $_db, $_data, $_sessionName,$_cookieName ,$_loggedin;
    public function __construct($user = null){
        $this->_db = DB::getInstance();
        $this->_sessionName = Config::get('session/session_name');
        $this->_cookieName = Config::get('remember/cookie_name');
        if(!$user){
            if(Session::exists($this->_sessionName)){
                $user = Session::get($this->_sessionName);
                if($this->find($user)){
                    $this->_loggedin = true;
                }
            }
        }else{
            $this->find($user);
        }
    }
    public function data(){
            return $this->_data;
    }
    public function register($fields = array()){
        if(!$this->_db->insert('users', $fields)){
            throw new Exception('Something went wrong with the registration.');
        }
    }
    public function find($user){
        $field = (is_numeric($user)) ? 'id' : 'username';
        $data = $this->_db->get('users', array($field, '=', $user));
        if($data->count()){
            $this->_data = $data->first();
            return true;
        }
    }
    public function login($username, $password, $remember = true){
        $user = $this->find($username);
        if($user){
            $password_matches = password_verify( $password, $this->data()->password );
            if($password_matches){
               Session::put($this->_sessionName, $this->data()->id);
               if($remember){
                   $hash = Hash::unique();
                   $hashcheck = $this->_db->get('users_sessions', array('user_id', '=', $this->data()->id));
                   if(!$hashcheck->count()){
                        $this->_db->insert('users_sessions',array(
                            'user_id' => $this->data()->id,
                            'hash'    => $hash
                        ));
                   }else{
                       $hash = $hashcheck->first()->hash;
                       Cookie::put($this->_cookieName, $hash, Config::get('remember/cookie_expiry'));
                   }
               }
               Session::flash('Logged in', 'You are logged in.');
               Redirect::to('profile');
                return true;
            }
        }
        return false;
    }
    public function logout(){
        if(Session::exists(Config::get('session/session_name'))){
            Session::delete(Config::get('session/session_name'));
        }
    }
    public function isLoggedIn(){
        return $this->_loggedin;
    }

}