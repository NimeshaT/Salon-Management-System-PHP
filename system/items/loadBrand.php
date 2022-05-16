<?php
include '../function.php';

$ItemTypeId=$_POST['ItemTypeId'];
$db= dbConn();
$sql="SELECT * FROM tbl_items_brand WHERE ItemTypeId='$ItemTypeId'";
$result=$db->query($sql);
?>
<select class="form-control" name="ItemBrandId" id="ItemBrandId">
    <option value="">--</option>
    <?php
    if($result->num_rows>0){
        while ($row=$result->fetch_assoc()){
    ?>
    <option value="<?php echo $row['ItemBrandId']; ?>"><?php echo $row['ItemBrand']; ?></option>
    <?php
        }
    }
    ?>
</select>

