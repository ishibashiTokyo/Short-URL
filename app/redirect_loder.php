<?php
include_once('manager/config.php');
require_once(CLASS_DIR . 'SURL.class.inc.php');

$SURL = new SURL;

if ( !isset($_GET['code']) || empty($_GET['code']) ){
    die('パラメータなし');
}

if ( !$SURL->isCode($_GET['code']) ) {
    $SURL->notFoundAndExit();
}

$SURL->redirect();
