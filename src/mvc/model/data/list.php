<?php
if ($notifications = new \bbn\Appui\Notification($model->db)) {
  return $notifications->getListByUser($model->inc->user->getId(), $model->data);
}
return ['success' => false];