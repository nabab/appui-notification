<?php
$notifications = new \bbn\Appui\Notification($model->db);
if (!empty($model->data['id_option'])
  && isset($model->data['web'], $model->data['browser'], $model->data['mail'], $model->data['mobile'])
) {
  return ['success' => $notifications->setCfg($model->data)];
}