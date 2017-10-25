<?php
function getAllBuilding() {
    $dbc = getDBC ();
    
    $resultArr = $dbc->query ( "CALL buildingList" );
    
    $dbc->close ();
    
    return $resultArr;
}
function delBuilding($rowID) {
    $dbc = getDBC ();
    
    $resultArr = $dbc->query ( "SELECT deleteBuildingByID($rowID) AS deleteResult" );
    
    $result = $resultArr->fetch_assoc ();
    
    $dbc->close ();
    
    return $result ['deleteResult'];
}
function addBuilding($bID, $bCode, $bName, $bAdd, $bMID) {
    $dbc = getDBC ();
    
    $resultArr = $dbc->query ( "SELECT insertBuilding (\"$bID\", \"$bCode\", \"$bName\", \"$bAdd\", \"$bMID\") AS insertResult" );
    
    $result = $resultArr->fetch_assoc ();
    
    $dbc->close ();
    
    return $result ['insertResult'];
}
?>