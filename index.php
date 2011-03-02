<?
ini_set('include_path', realpath(dirname(__FILE__) . "/lib") . ":" . ini_get('include_path'));
include('dwooAutoload.php'); 
require('pdf2up.php');
$GLOBALS['dwoo'] = new Dwoo(realpath(dirname(__FILE__) . "/compile"),realpath(dirname(__FILE__) . "/cache")); 
session_start();

function select_action()
{
    if ( !empty($_FILES) ) { // POST
        return handle_upload();
    }
    if ( $_GET["action"] == "view" ) {
        return handle_view();
    }
    else {
        return handle_index();
    }
}

function main() {
    $content = select_action();

    $data = array("content"=>$content);
    $GLOBALS['dwoo']->output('template/layout.tpl', $data);
}

main();
?>
