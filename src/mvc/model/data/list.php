<?php
if ($notifications = new \bbn\appui\notification($model->db)) {
  return $notifications->get_list_by_user($model->inc->user->get_id(), $model->data);
}
return ['success' => false];