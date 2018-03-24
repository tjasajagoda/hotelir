<?php

    return (object) array(
        //DB settings
        'host' => 'slavnik.fri.uni-lj.si',
        'username' => 'tj9557',
        'pass' => 'iqtvurjk5p',
        'database' => 's3_2017',
        //Account lock settings
        'numberOfRetries' => 3,
        'watchPeriod' => 10, //x minutes
        'lockPeriod' => 5, //x minutes
        //User info
        'loginHistoryCount' => 3
    );

?>