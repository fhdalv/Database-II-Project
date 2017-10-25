<?php
include_once 'functions/functionsBuilding.php';
include_once 'functions/functionsStaff.php';
include_once 'functions/functionsPerson.php';
include_once 'header.php';

$bID = getIfSet ( "bID" );
$bCode = getIfSet ( "bCode" );
$bName = getIfSet ( "bName" );
$bAdd = getIfSet ( "bAdd" );
$bMID = getIfSet ( "bMID" );

if (isValid_and_set ( "bID" ) && is_numeric ( $_GET ['bID'] ) && isValid_and_set ( "bCode" ) && isValid_and_set ( "bName" ) && isValid_and_set ( "bAdd" ) && isValid_and_set ( "bMID" ) && is_numeric ( $_GET ['bMID'] )) {

    $insertResult = addBuilding ( $_GET ['bID'], $_GET ['bCode'], $_GET ['bName'], $_GET ['bAdd'], $_GET ['bMID'] );
    
    if ($insertResult == - 1)
        showErrorMessage ( "Failed to insert row ID $bID. PK repeated" );
    elseif ($insertResult == 0)
        showErrorMessage ( "Failed to insert row ID $bID" );
    else
        showInfoMessage ( "Successfully inserted row ID $bID" );
} else if (isset ( $_GET ['btnAddBuilding'] ))
    showErrorMessage ( "Please enter valid values" );

?>
<form name="frmAddBuilding" accept-charset="buildingAdd.php">
    <table border="0">
        <tr>
            <td width="90">
                <strong>Staff ID:</strong>
            </td>
            <td>
				<select name=bMID>
				<?php
	
					$result = getAllStaff();

					if ($result->num_rows > 0) {
    
					while ( $rows = $result->fetch_assoc () ) {
					echo" <option value={$rows['PERSON_ID']}>";
					echo $rows ['PERSON_ID']." ".$rows ['LAST_NAME']." ".$rows ['FIRST_NAME'];
					echo "</option>";
					}
				}
				?>
				</select>      
            </td>
        </tr>
        <tr>
            <td>
                <strong>Code:</strong>
            </td>
            <td>
                <input type=text name=bCode value="<?= $bCode ?>" />
            </td>
        </tr>
        <tr>
            <td>
                <strong>Name:</strong>
            </td>
            <td>
                <input type=text name=bName value="<?= $bName ?>" />
            </td>
        </tr>
        <tr>
            <td>
                <strong>Address:</strong>
            </td>
            <td>
                <input type=text name=bAdd value="<?= $bAdd ?>" />
            </td>
        </tr>
        <tr>
            <td>
                <strong>ID:</strong>
            </td>
            <td>
                <input type=text name=bID value="<?= $bID ?>" />
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <button type=submit name=btnAddBuilding>Add</button>
                <button type=reset>Reset</button>
            </td>
        </tr>
    </table>
</form>

<?php
include_once 'footer.php';
?>