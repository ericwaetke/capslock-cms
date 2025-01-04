<?php

Kirby::plugin('ericwaetke/api', [
  'api' => [
    'routes' => [
      [
        'pattern' => 'csrf',
        'action'  => csrf()
      ]
    ]
  ]
]);