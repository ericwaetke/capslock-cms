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
  ]
];