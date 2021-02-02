<?php
if (($notifications = new \bbn\Appui\Notification($model->db))
  && ($id_user = $model->inc->user->getId())
  && \bbn\Str::isUid($id_user)
) {
  return [
    'schema' => $notifications->getClassCfg()['arch']
  ];
}