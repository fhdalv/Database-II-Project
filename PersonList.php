
<?php
include_once 'functions/functionsPerson.php';
include_once 'header.php';
?>
<form name="frmListPerson" accept-charset="personList.php">

<input type=submit name=but1 value=SortByLastName(Asc) />&nbsp;
<input type=submit name=but2 value=SortByLastName(Desc) />&nbsp;
<input type=submit name=but3 value=SortByID />

</form>

<?php


if (isset ( $_GET ['delRowId'] )) {
    
    $rowID = $_GET ['delRowId'];
    
    $deleteResult = delPerson ( $rowID );
    
    if ($deleteResult == - 1)
        showErrorMessage ( "Failed to delete row ID $rowID. FK Violation" );
    elseif ($deleteResult == 0)
        showErrorMessage ( "Failed to deleted row ID $rowID" );
    else
        showInfoMessage ( "Successfully deleted row ID $rowID" );
}
if(isset ( $_GET ['but3'] )){
$result = getAllPerson ();

if ($result->num_rows > 0) {
    // Print table's header
    echo '<table width="100%" border="1">
            <tr>
                <td><strong>ID</strong></td>
                <td><strong>Last Name</strong></td>
                <td><strong>First Name</strong></td>
                <td><strong>DOB</strong></td>
                <td><strong>Address</strong></td>
                <td>&nbsp;</td>
            </tr>';
    
    // Print table's body
    while ( $rows = $result->fetch_assoc () ) {
        
        echo "<tr>
                <td>{$rows ['id']}</td>
                <td>{$rows ['last_name']}</td>
                <td>{$rows ['first_name']}</td>
                <td>{$rows ['DOB']}</td>
                <td>{$rows ['address']}</td>
                <td>
                    <form action=personList.php>
                        <input type=hidden name=delRowId value=\"{$rows ['id']}\" />
                        <button type=submit>Delete</button>
                    </form>
                </td>
            </tr>";
    }
    
    echo '</table>';
}
} // END IF 3
if(isset ( $_GET ['but1'] )){
$result = getAllPersonAsc ();

if ($result->num_rows > 0) {
    // Print table's header
    echo '<table width="100%" border="1">
            <tr>
                <td><strong>ID</strong></td>
                <td><strong>Last Name</strong></td>
                <td><strong>First Name</strong></td>
                <td><strong>DOB</strong></td>
                <td><strong>Address</strong></td>
                <td>&nbsp;</td>
            </tr>';
    
    // Print table's body
    while ( $rows = $result->fetch_assoc () ) {
        
        echo "<tr>
                <td>{$rows ['id']}</td>
                <td>{$rows ['last_name']}</td>
                <td>{$rows ['first_name']}</td>
                <td>{$rows ['DOB']}</td>
                <td>{$rows ['address']}</td>
                <td>
                    <form action=personList.php>
                        <input type=hidden name=delRowId value=\"{$rows ['id']}\" />
                        <button type=submit>Delete</button>
                    </form>
                </td>
            </tr>";
    }
    
    echo '</table>';
}
} // END IF 1
if(isset ( $_GET ['but2'] )){
$result = getAllPersonDesc ();

if ($result->num_rows > 0) {
    // Print table's header
    echo '<table width="100%" border="1">
            <tr>
                <td><strong>ID</strong></td>
                <td><strong>Last Name</strong></td>
                <td><strong>First Name</strong></td>
                <td><strong>DOB</strong></td>
                <td><strong>Address</strong></td>
                <td>&nbsp;</td>
            </tr>';
    
    // Print table's body
    while ( $rows = $result->fetch_assoc () ) {
        
        echo "<tr>
                <td>{$rows ['id']}</td>
                <td>{$rows ['last_name']}</td>
                <td>{$rows ['first_name']}</td>
                <td>{$rows ['DOB']}</td>
                <td>{$rows ['address']}</td>
                <td>
                    <form action=personList.php>
                        <input type=hidden name=delRowId value=\"{$rows ['id']}\" />
                        <button type=submit>Delete</button>
                    </form>
                </td>
            </tr>";
    }
    
    echo '</table>';
}
} // END IF 2

include_once 'footer.php';
?>