<?php
$notifications = new \bbn\Appui\Notification($model->db);
$id_user = $model->inc->user->getId();
return [
  'schema' => $notifications->getClassCfg()['arch'],
  'global' => array_merge(['id_option' => $model->inc->options->fromCode('cfg', 'notification', 'appui')], $notifications->getCfg($id_user)),
];