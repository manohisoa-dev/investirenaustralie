<?php

return array(
    /**Devloped by Pakainfo.com  set your paypal credential **/
    'client_id' => 'AUDqPBhmtfy2wkHgesFw74fRcVacpByf0BlQXv0s_gJi8PvP9HmSunfPEpk-EpCc33E6929EQY1lCqjY',
    'secret' => 'EOnX_el6MU9_90VoZ6_hQy2hOOpkaA1MELSsrV0lw3BrwX-sDcSLkkaXkTMU0eW9ijdYieNiE_1PEP4Q',
    'settings' => array(
        'mode' => 'sandbox',
        'http.ConnectionTimeOut' => 1000,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/paypal.log',
        'log.LogLevel' => 'FINE'),
    );