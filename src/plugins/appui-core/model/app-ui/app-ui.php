<?php

use bbn\Mvc;
/** @var bbn\Mvc\Model $model The current model */

return [
  'status' => [
    'content' => Mvc::getInstance()->subpluginView('app-ui/button', 'html', [], 'appui-notification', 'appui-core'),
    'script' => Mvc::getInstance()->subpluginView('app-ui/button', 'js', [], 'appui-notification', 'appui-core'),
  ],
  'central' => [
    'content' => Mvc::getInstance()->subpluginView('app-ui/main', 'html', [], 'appui-notification', 'appui-core'),
    'script' => Mvc::getInstance()->subpluginView('app-ui/main', 'js', [], 'appui-notification', 'appui-core'),
  ]
];


