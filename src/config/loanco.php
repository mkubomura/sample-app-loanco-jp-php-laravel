<?php

return [
    'docusign_environment' => env('DOCUSIGN_ENVIRONMENT', 'demo'),
    'docusign_host' => env('DOCUSIGN_HOST', 'account-d.docusign.com'),
    'docusign_userguid' => env('DOCUSIGN_USERGUID'),
    'docusign_username' => env('DOCUSIGN_USERNAME'),
    'docusign_password' => env('DOCUSIGN_PASSWORD'),
    'docusign_integratorkey' => env('DOCUSIGN_IK'),
    'employee_email' => env('EMPLOYEE_EMAIL'),
    'employee_name' => env('EMPLOYEE_NAME'),
    'local_return_url' => env('LOCAL_RETURN_URL','http://localhost:8080/'),
    'brand_id' => env('BRAND_ID'),
    'google_maps_api_key' => env('GOOGLE_MAPS_API_KEY'),
    'google_analytics' => env('GOOGLE_ANALYTICS'),
    'default_email' => env('DEFAULT_EMAIL'),
    'force_https' => env('FORCE_HTTPS'),
    'use_local_certs' => env('USE_LOCAL_CERTS', 'false')
];

