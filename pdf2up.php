<?

function fail($info,$msg=null)
{
    if (is_array($info))
        $info = join("/n",$info);
    print "<pre>";
    print $info;
    print "</pre>";
    if ($msg == null)
        die("Failure.");
    else
        die($msg);
}
function handle_upload() {
    $tmpfname = $_FILES["file"]["tmp_name"];
    $uuid=uniqid(rand(), true);
    $fname="/tmp/pdf2upjob-".$uuid.".pdf";
    if ( !move_uploaded_file($tmpfname,$fname) )
        die("Could not move uploaded file.");
    chmod($fname, 0644); // let everyone read

    $outfname="/tmp/pdf2upjob-".$uuid."-out.pdf";
    $output=array();
    $cmd = "/home/loevborg/public_html/pdf2up/processpdf.sh ";

    if ( $_POST["pages"] == "skipfirst" ) {
        $cmd .= "-p ";
    }
    elseif ( $_POST["pages"] == "list" ) {
        $lst = $_POST["plist"];
        if (! (strlen($lst) >= 1) || preg_match('/[^0-9,-]/',$lst) ) {
            fail("invalid page list");
        }

        $cmd .= "-r " . $lst . " ";
    }
    elseif ( $_POST["pages"] != "all" ) {
        fail("not implemented");
    }

    if ( $_POST["format"] == "letter" )
        $cmd .= "-t letter ";

    $cmd .= $fname . " " . $outfname;

    $ret = exec($cmd);
    if ( false === $ret )
    {
        fail($output,"returned false");
    }
    if ( !file_exists($outfname) )
    {
        fail($output,"output file not found");
    }
    if ( filesize($outfname) < 1000 )
    {
        fail($output,"output file too small");
    }

    show_pdf($outfname);
    exit;
}

function show_pdf($fname) {
    $outname = $_FILES["file"]["name"];
    $outname = preg_replace("/.pdf$/i","",$outname);
    $outname .= "-2x1.pdf";

    header('Content-type: application/pdf');
    header('Content-Disposition: inline; filename="'.$outname);
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Content-Transfer-Encoding: binary');
    header('Conent-Length: ' . filesize($fname));
    readfile($fname);
    exit;
}

function handle_index() {
    $content = $GLOBALS['dwoo']->get('template/index.tpl', array());
    return $content;
}

?>
