<?php
function getAllStaff() {
    $dbc = getDBC ();
    
    $resultArr = $dbc->query ( "CALL staffList" );
    
    $dbc->close ();
    
    return $resultArr;
}
function delStaff($rowID) {
    $dbc = getDBC ();
    
    $resultArr = $dbc->query ( "SELECT deleteStaffByID($rowID) AS deleteResult" );
    
    $result = $resultArr->fetch_assoc ();
    
    $dbc->close ();
    
    return $result ['deleteResult'];
}
function addStaff($sPID, $sENum, $sSDate, $sEDate, $sSal) {
    $dbc = getDBC ();
    if(empty($sEDate)){
		$sEDate = 'null';
	}else 
		$sEDate = "\".$GET[sEDate].\"";
    $resultArr = $dbc->query ( "SELECT insertStaff (\"$sPID\", \"$sENum\", \"$sSDate\", $sEDate, \"$sSal\") AS insertResult" );
    
    $result = $resultArr->fetch_assoc ();
    
    $dbc->close ();
    
    return $result ['insertResult'];
}
?>