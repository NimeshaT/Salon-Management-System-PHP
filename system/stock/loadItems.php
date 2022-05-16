<?php
include '../function.php';

$ItemTypeId=$_POST['ItemTypeId'];
$db= dbConn();
$sql="SELECT * FROM tbl_items WHERE ItemTypeId='$ItemTypeId'";
$result=$db->query($sql);
?>
<select class="form-control" name="ItemId" id="ItemId">
    <option value="">--</option>
    <?php
    if($result->num_rows>0){
        while ($row=$result->fetch_assoc()){
    ?>
    <option value="<?php echo $row['ItemId']; ?>"><?php echo $row['ItemName']; ?></option>
    <?php
        }
    }
    ?>
</select>

