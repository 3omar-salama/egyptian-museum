<?php
require '../vendor/autoload.php';

use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

$apiContext = new ApiContext(
    new OAuthTokenCredential(
        'Ab6M3N2ZXVmUyjq8clUyjNeQg0jIICqYrgAtMCAzgG_ngNvFcVa4BldoYpAODak7gf2UrFrIbBvSg-WR',
        'EDhVlODWfKL9lc_pW3gsQc9HnUcgLOkn8CTwLAdJIIinjaLP2m9guNJtVJ8pnu0r7iBRrAGsWzEYfgQa'
    )
);

$apiContext->setConfig([
    'mode' => 'sandbox', // or 'live' for production
    'http.ConnectionTimeOut' => 30,
    'log.LogEnabled' => true,
    'log.FileName' => 'PayPal.log',
    'log.LogLevel' => 'FINE',
    'validation.level' => 'log'
]);
?>
