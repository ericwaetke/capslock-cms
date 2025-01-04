<?php

Kirby::plugin('ericwaetke/api', [
  'api' => [
    'routes' => [
      [
        'pattern' => 'csrf',
        'action'  => function () {
          return csrf();
        },
      ]
    ]
  ]
]);