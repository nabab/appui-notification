<?php
/*
 * Describe what it does to show you're not that dumb!
 *
 **/

/** @var bbn\Mvc\Controller $ctrl */
$ctrl->obj->url = APPUI_NOTIFICATIONS_ROOT . 'page';
$perms = [];
if ( $list = $ctrl->inc->options->fullOptions('page/', 'access', 'permissions', 'notification', 'appui') ){
  foreach ($list as $p) {
    $perms[$p['code']] = $ctrl->inc->perm->has($p['id']);
  }
}
$notifications = new \bbn\Appui\Notification($ctrl->db);
$ctrl
  ->setIcon('nf nf-mdi-comment_alert_outline')
  ->combo(_('Notifications'), [
    'permissions' => $perms,
    'cfg' => $notifications->getClassCfg()
  ]);