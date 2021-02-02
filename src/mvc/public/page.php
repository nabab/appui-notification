<?php
/*
 * Describe what it does to show you're not that dumb!
 *
 **/

/** @var $ctrl \bbn\Mvc\Controller */
$ctrl->obj->url = APPUI_NOTIFICATIONS_ROOT . 'page';
$perms = [];
foreach ($ctrl->inc->perm->fullOptions(APPUI_NOTIFICATIONS_ROOT.'page/') as $p) {
  $perms[$p['code']] = true;
}
$notifications = new \bbn\Appui\Notification($ctrl->db);
$ctrl
  ->setIcon('nf nf-mdi-comment_alert_outline')
  ->combo(_('Notifications'), [
    'permissions' => $perms,
    'cfg' => $notifications->getClassCfg() 
  ]);