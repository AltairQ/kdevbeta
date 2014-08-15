<?php
require_once 'util/inc_all.php';

if (!authcheck()) {
	die();
}

$Plid = filter_var($_POST['lid'], FILTER_SANITIZE_NUMBER_INT);
$Pid = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
$userid = $_SESSION['userid'];
$Pgrade = filter_var($_POST['grade'], FILTER_SANITIZE_NUMBER_INT);


$action = $_POST['action'];

if ($action == "getnew" || $action == "answer") {


if ($action == "answer" && isset($Pid) && isset($Plid) && isset($Pgrade) && $Pgrade >= 0 && $Pgrade <= 5) {

    $row = getRep($DB, $userid, $Plid, $Pid);
    if (empty($row) || $row == -100) {
        die();
    }

    if ($row['repid']==1) {
        $row['ef'] = 2.5;
    }
    else
    {
        $row['ef'] = newEF($row['ef'], $Pgrade);    
    }
    

    if ($Pgrade >= 4) {
        $row['replen']= floor( newI($row['replen'], $row['ef'], $row['repid']));
        $rlen = $row['replen'];

        if ($row['repid'] == 1) {
            $row['repnext'] = date('Y-m-d',  strtotime("+ $rlen day"));
        }
        else
        {
        $dtemp= strtotime("+ $rlen days", strtotime($row['repnext']));
        $row['repnext']=date("Y-m-d H:i:s", $dtemp);
        }

        $row['repid']++;
       
       
    }
    updateRep($DB, $userid, $row);
}




//dopiero teraz pobieramy nowe


    $nextrep = getNewRep($DB, $userid);

    if ($nextrep === -100) {
           echo json_encode(array('code' => -100));
           die();
        }

      if (empty($nextrep) ) {
           echo json_encode(array('code' => 0));
           die();
        }

    $word = getWord($DB, $nextrep['list_id'], $nextrep['word_id'], $userid);

    if (empty($word) || $word == -100) {
        echo json_encode(array('code' => -100));
        die();
    }


    $ret = array('lid' => $nextrep['list_id'],
                'id' => $nextrep['word_id'],
                'front' => $word['front'],
                'back' => $word['back'],
                'code' => 1
                );

    echo json_encode($ret);


    // https://www.youtube.com/watch?v=fU02v-3TSFw





}



?>
