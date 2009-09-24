<?
ini_set('include_path', realpath(dirname(__FILE__) . "/lib") . ":" . ini_get('include_path'));
include('dwooAutoload.php'); 
require('pdf2up.php');
$GLOBALS['dwoo'] = new Dwoo(realpath(dirname(__FILE__) . "/compile"),realpath(dirname(__FILE__) . "/cache")); 
session_start();

function select_action()
{
    if ( !empty($_FILES) ) { // POST
        handle_upload();
    }
    else {
        $content = handle_index();
    }
    return $content;
}

function main() {
    $content = select_action();

    $data = array("content"=>$content);
    $GLOBALS['dwoo']->output('template/layout.tpl', $data);
}

main();
?>
