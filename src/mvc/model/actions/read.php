<?php
if ($notifications = new \bbn\Appui\Notification($model->db)) {
  if ((!empty($model->data['id']) && \bbn\Str::isUid($model->data['id']))
    || (!empty($model->data['ids']) && is_array($model->data['ids']))
  ) {
    return ['success' => $notifications->read($model->data['id'] ?? $model->data['ids'])];
  }
  else if (!empty($model->data['all'])) {
    return ['success' => $notifications->readAll()];
  }
}
return ['success' => false];