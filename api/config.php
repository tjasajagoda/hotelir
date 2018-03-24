<?php

    return (object) array(
        //DB settings
        'host' => 'localhost',
        'username' => 'pametnih_hotelir',
        'pass' => 'admin11',
        'database' => 'pametnih_hotelir',
        //Account lock settings
        'numberOfRetries' => 3,
        'watchPeriod' => 10, //x minutes
        'lockPeriod' => 5, //x minutes
        //User info
        'loginHistoryCount' => 3
    );

?>