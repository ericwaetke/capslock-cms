<?php

return [
  'debug' => true,
  'api' => [
    'basicAuth' => true
  ],
  'panel' =>[
      'install' => true
  ],
  'headless' => [
    'token' => 'test',
    'panel' => [
        'frontendUrl' => 'https://changecollective.woven.design',
        'redirect' => true
    ]
  ],
  'url' => [
    'https://capslock-cms.woven.design',
    'https://capslock-cms.test',
    'http://localhost:80'
  ],
  'ericwaetke.rebuild-frontend' => [
    'enabled' => $_ENV['REDEPLOY_ENABLED'] ?? false,
    'dokploy' => [
      'url' => 'https://dokploy.woven.design/',
      'token' => $_ENV['DOKPLOY_TOKEN'] ?? '',
      'application_id' => '9Sesx2yf-O0_WnqQnrN6Z'
    ]
  ],
];