<?php
$id_user = $model->inc->user->getId();
$path_web = \bbn\Mvc::getUserDataPath($id_user, 'appui-notification') . 'web/' . $model->inc->user->getOsession('id_session');
$path_browser = \bbn\Mvc::getUserDataPath($id_user, 'appui-notification') . 'browser/' . $model->inc->user->getOsession('id_session');
$notifications = new \bbn\Appui\Notification($model->db);
$ncfg = $notifications->getClassCfg();
return [[
  'id' => 'appui-notification-0',
  'frequency' => 1,
  'function' => function(array $data) use($path_web, $path_browser, $notifications, $id_user, $model, $ncfg){
    $res = [
      'success' => true,
      'data' => []
    ];
    if (count($data['clients'])) {
      end($data['clients']);
      $is_last = $data['client'] === key($data['clients']);
      if (is_dir($path_web)) {
        foreach (\bbn\File\Dir::getFiles($path_web) as $file) {
          if ($json = json_decode(file_get_contents($file), true)) {
            if (!isset($res['data']['web'])) {
              $res['data']['web'] = [];
            }
            $res['data']['web'][] = $json;
          }
          if ($is_last) {
            \bbn\File\Dir::delete($file);
            if (!\bbn\File\Dir::getFiles($path_web)) {
              \bbn\File\Dir::delete($path_web);
            }
          }
        }
      }
      if (is_dir($path_browser)) {
        foreach (\bbn\File\Dir::getFiles($path_browser) as $file) {
          if ($json = json_decode(file_get_contents($file), true)) {
            if (!isset($res['data']['browser'])) {
              $res['data']['browser'] = [];
            }
            $res['data']['browser'][] = $json;
          }
          if ($is_last) {
            \bbn\File\Dir::delete($file);
            if (!\bbn\File\Dir::getFiles($path_browser)) {
              \bbn\File\Dir::delete($path_browser);
            }
          }
        }
      }
      $unread = $model->getModel($model->pluginUrl('appui-notification').'/data/list', [
        'filters' => [
          'conditions' => [[
            'field' => $model->db->colFullName($ncfg['arch']['notifications']['read'], $ncfg['table']),
            'operator' => "isnull"
          ], [
            'logic' => 'OR',
            'conditions' => [[
              'field' => $model->db->colFullName($ncfg['arch']['notifications']['web'], $ncfg['table']),
              'operator' => "isnotnull"
            ], [
              'field' => $model->db->colFullName($ncfg['arch']['notifications']['browser'], $ncfg['table']),
              'operator' => "isnotnull"
            ], [
              'field' => $model->db->colFullName($ncfg['arch']['notifications']['mail'], $ncfg['table']),
              'operator' => "isnotnull"
            ], [
              'field' => $model->db->colFullName($ncfg['arch']['notifications']['mobile'], $ncfg['table']),
              'operator' => "isnotnull"
            ]]
          ]]
        ],
        'limit' => 0,
        'start' => 0
      ]);
      $hash = md5(json_encode($unread['data']));
      if (isset($data['data']['unreadHash']) && ($hash !== $data['data']['unreadHash'])) {
        $res['data']['unreadHash'] = $hash;
        $res['data']['unread'] = $unread['data'];
        $res['data']['serviceWorkers'] = ['unreadHash' => $hash];
      }
    }
    return $res;
  }
]];