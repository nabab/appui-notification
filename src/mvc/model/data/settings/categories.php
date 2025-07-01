<?php
if (($notifications = new \bbn\Appui\Notification($model->db))
  && ($id_user = $model->inc->user->getId())
  && \bbn\Str::isUid($id_user)
) {
  return [
    'success' => true,
    'data' => array_map(function($o) use($notifications, $id_user){
      return array_merge([
        'id_option' => $o['id'],
        'text' => $o['text']
      ], $notifications->getCfg($id_user, $o['id']));
    }, array_values(array_filter($model->inc->options->fullOptions('list', 'notification', 'appui'), function($o) use($model){
      $id_perm = $model->inc->perm->optionToPermission($o['id']);
      return $id_perm && $model->inc->perm->has($id_perm);
    })))
  ];
}
return ['success' => false];