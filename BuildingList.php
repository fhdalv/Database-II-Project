<?php
include_once 'functions/functionsBuilding.php';

include_once 'header.php';

if (isset ( $_GET ['delRowId'] )) {
    
    $rowID = $_GET ['delRowId'];
    
    $deleteResult = delBuilding ( $rowID );
    
    if ($deleteResult == - 1)
        showErrorMessage ( "Failed to delete row ID $rowID. FK Violation" );
    elseif ($deleteResult == 0)
        showErrorMessage ( "Failed to deleted row ID $rowID" );
    else
        showInfoMessage ( "Successfully deleted row ID $rowID" );
}

$result = getAllBuilding ();

if ($result->num_rows > 0) {
    // Print table's header
    echo '<table width="100%" border="1">
            <tr>
                <td><strong>Manager ID</strong></td>
                <td><strong>First Name</strong></td>
                <td><strong>Last Name</strong></td>
				<td><strong>DOB</strong></td>
                <td><strong>Salary</strong></td>
				<td><strong>Employee #</strong></td>
                <td><strong>Code</strong></td>
                <td><strong>Name</strong></td>
                <td><strong>Address</strong></td>
                <td><strong>ID</strong></td>
                <td>&nbsp;</td>
            </tr>';
    
    // Print table's body
    while ( $rows = $result->fetch_assoc () ) {
        
        echo "<tr>
                <td>{$rows ['MANAGER_ID']}</td>
                <td>{$rows ['FIRST_NAME']}</td>
				<td>{$rows ['LAST_NAME']}</td>
				<td>{$rows ['DOB']}</td>
				<td>{$rows ['SALARY']}</td>
				<td>{$rows ['EMP_NUM']}</td>
                <td>{$rows ['CODE']}</td>
                <td>{$rows ['NAME']}</td>
                <td>{$rows ['ADDRESS']}</td>
                <td>{$rows ['ID']}</td>
                <td>
                    <form action=buildingList.php>
                        <input type=hidden name=delRowId value=\"{$rows ['ID']}\" />
                        <button type=submit>Delete</button>
                    </form>
                </td>
            </tr>";
    }
    
    echo '</table>';
}
include_once 'footer.php';
?>