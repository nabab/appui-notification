<?php
$notifications = new \bbn\Appui\Notification($model->db);
$ucfg = $model->inc->user->getClassCfg();
$ncfg = $notifications->getClassCfg();
$grid = new \bbn\Appui\Grid($model->db, $model->data, [
  'table' => $ncfg['table'],
  'fields' => [
    $model->db->colFullName($ncfg['arch']['notifications']['id'], $ncfg['table']),
    $model->db->colFullName($ncfg['arch']['notifications']['id_content'], $ncfg['table']),
    $model->db->colFullName($ncfg['arch']['notifications']['id_user'], $ncfg['table']),
    $model->db->colFullName($ncfg['arch']['notifications']['web'], $ncfg['table']),
    $model->db->colFullName($ncfg['arch']['notifications']['browser'], $ncfg['table']),
    $model->db->colFullName($ncfg['arch']['notifications']['mail'], $ncfg['table']),
    $model->db->colFullName($ncfg['arch']['notifications']['mobile'], $ncfg['table']),
    $model->db->colFullName($ncfg['arch']['notifications']['read'], $ncfg['table']),
    $model->db->colFullName($ncfg['arch']['content']['id_option'], $ncfg['tables']['content']),
    $model->db->colFullName($ncfg['arch']['content']['title'], $ncfg['tables']['content']),
    $model->db->colFullName($ncfg['arch']['content']['content'], $ncfg['tables']['content']),
    $model->db->colFullName($ncfg['arch']['content']['creation'], $ncfg['tables']['content'])
  ],
  'join' => [[
    'table' => $ncfg['tables']['content'],
    'on' => [
      'conditions' => [[
        'field' => $model->db->colFullName($ncfg['arch']['notifications']['id_content'], $ncfg['table']),
        'exp' => $model->db->colFullName($ncfg['arch']['content']['id'], $ncfg['tables']['content'])
      ]]
    ]
  ], [
    'table' => $ucfg['table'],
    'on' => [
      'conditions' => [[
        'field' => $model->db->colFullName($ucfg['arch']['users']['id'], $ucfg['table']),
        'exp' => $model->db->colFullName($ncfg['arch']['notifications']['id_user'], $ncfg['table'])
      ]]
    ]
  ]],
  'order' => [[
    'field' => $model->db->colFullName($ncfg['arch']['content']['creation'], $ncfg['tables']['content']),
    'dir' => 'DESC'
  ]]
]);
if ($grid->check()) {
  return $grid->getDatatable();
}