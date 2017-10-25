<?php
include_once 'functions/functionsStaff.php';
include_once 'functions/functionsPerson.php';
include_once 'header.php';

$sPID = getIfSet ( "sPID" );
$sENum = getIfSet ( "sENum" );
$sSDate = getIfSet ( "sSDate" );
$sEDate = getIfSet ( "sEDate" );
$sSal = getIfSet ( "sSal" );

if (isValid_and_set ( "sPID" ) && is_numeric ( $_GET ['sPID'] ) && isValid_and_set ( "sENum" ) && isValid_and_set ( "sSDate" ) && isValid_and_set ( "sSal" ) && is_numeric ( $_GET ['sSal'] )) {
	
	if ($sEDate == '0000-00-00') {
	$sEDate = null;}

    $insertResult = addStaff ( $_GET ['sPID'], $_GET ['sENum'], $_GET ['sSDate'], $_GET ['sEDate'], $_GET ['sSal'] );
    
    if ($insertResult == - 1)
        showErrorMessage ( "Failed to insert row ID $sPID. PK repeated" );
    elseif ($insertResult == 0)
        showErrorMessage ( "Failed to insert row ID $sPID" );
    else
        showInfoMessage ( "Successfully inserted row ID $sPID" );
} else if (isset ( $_GET ['btnAddStaff'] ))
    showErrorMessage ( "Please enter valid values" );

?>
<form name="frmAddStaff" accept-charset="staffAdd.php">
    <table border="0">
        <tr>
            <td width="90">
                <strong>Person:</strong>
            </td>
            <td>
				<select name=sPID>
				<?php
	
					$result = getAllPerson ();

					if ($result->num_rows > 0) {
    
					while ( $rows = $result->fetch_assoc () ) {
					echo" <option value={$rows['id']}>";
					echo $rows ['id']." ".$rows ['last_name']." ".$rows ['first_name'];
					echo "</option>";
					}
				}
				?>
				</select>
            </td>
        </tr>
        <tr>
            <td>
                <strong>Employee Number:</strong>
            </td>
            <td>
                <input type=text name=sENum value="<?= $sENum ?>" />
            </td>
        </tr>
        <tr>
            <td>
                <strong>Start Date:</strong>
            </td>
            <td>
                <input type=text name=sSDate value="<?= $sSDate ?>" />
            </td>
        </tr>
        <tr>
            <td>
                <strong>End Date:</strong>
            </td>
            <td>
                <input type=text name=sEDate value="<?= $sEDate ?>" />
            </td>
        </tr>
        <tr>
            <td>
                <strong>Salary:</strong>
            </td>
            <td>
                <input type=text name=sSal value="<?= $sSal ?>" />
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <button type=submit name=btnAddStaff>Add</button>
                <button type=reset>Reset</button>
            </td>
        </tr>
    </table>
</form>

<?php
include_once 'footer.php';
?>