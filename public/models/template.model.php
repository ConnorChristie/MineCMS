<?php

class userModel {

    public $id;
    /*
     * Case sensitive username. E.g. cOolp4yer
     */
    public $username;
    /*
     *
     */
    public $username_clean;
    public $email;
    public $password;
    public $regdate;
    public $lastseen;
    /*
     * 0 - Unconfirmed
     * 1 - Confirmed
     * 2 - Deactivated
     */
    public $status;


    function __construct() {
    }

    function load() {
        /*
         * Load users row from database by ID.
         */
        
    }
    function update($id){
        /*
         * Update users row using class data.
         */
    }
    function save(){
        /*
         * Save class to new user row.
         */
    }


}

?>
