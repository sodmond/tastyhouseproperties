<?php

/*
 * Configuration for VerifyMe
 */

return [

    /**
     * Client ID From Registered QoreID Account
     *
     */
    'clientId' => getenv('QOREID_CLIENT_ID'),

    /**
     * Secret Key From Registered QoreID Account
     *
     */
    'secretKey' => getenv('QOREID_SECRET_KEY'),

    /**
     * QoreID Base URL
     *
     */
    'baseUrl' => getenv('QOREID_BASE_URL'),

];
