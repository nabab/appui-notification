<?php
if (($notifications = new \bbn\Appui\Notification($model->db))
  && ($ncfg = $notifications->getClassCfg())
  && !empty($model->data[$ncfg['arch']['notifications']['id']])
  && \bbn\Str::isUid($model->data[$ncfg['arch']['notifications']['id']])
) {
  return ['success' => $notifications->delete($model->data[$ncfg['arch']['notifications']['id']])];
}
return ['success' => false];