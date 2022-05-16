<?php
include '../function.php';

$ItemTypeId=$_POST['ItemTypeId'];
$db= dbConn();
$sql="SELECT * FROM tbl_items_category WHERE ItemTypeId='$ItemTypeId'";
$result=$db->query($sql);
?>
<select class="form-control" name="ItemCategoryId" id="ItemCategoryId">
    <option value="">--</option>
    <?php
    if($result->num_rows>0){
        while ($row=$result->fetch_assoc()){
    ?>
    <option value="<?php echo $row['ItemCategoryId']; ?>"><?php echo $row['ItemCategoryName']; ?></option>
    <?php
        }
    }
    ?>
</select>

