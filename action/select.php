<?php

security_check();

$_city = city_fetch($_GET['id']);

// debug_pre($_SESSION);
// debug_pre($_city);

city_set($_user['id'], $_city['id']);

security_set_user_session($_user['id']);

message_set('City Selection Success', 'You are now working on '.$_city['name'].'.');
header_redirect(ENV_DOMAIN.'/console/dashboard');
