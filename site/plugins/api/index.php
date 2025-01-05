<?php

Kirby::plugin('ericwaetke/api', [
  'api' => [
    'routes' => function($kirby) {
      return [
        [
          'pattern' => 'customLogin',
          'action'  => function () use ($kirby) {
            if($username = get('email') and $password = get('password')) {

              $auth = $kirby->auth();
              $user = $auth->login($username, $password);
            
              if($user) {
                // Return JSON user and csrf token
                $csrf = $auth->csrfFromSession();
                $user = $user->toArray();
                $user['csrf'] = $csrf;
                $user['status'] = $auth->log();
                return $user;
              } else {
                return 'invalid username or password';
              }
            
            } else {
              if (!$username) {
                return 'missing username';
              }
              if (!$password) {
                return 'missing password';
              }
            }
            // return csrf();
          },
        ]
        ];
    } 
  ]
]);