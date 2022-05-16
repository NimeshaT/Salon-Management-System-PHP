<?php
include '../function.php';

$ItemTitleId=$_POST['ItemTitleId'];
$db= dbConn();
$sql="SELECT * FROM tbl_items_type WHERE ItemTitleId='$ItemTitleId'";
$result=$db->query($sql);
?>
<select class="form-control" name="ItemTypeId" id="ItemTypeId" onchange="loadItemCategory(this.value);loadItemBrand(this.value);">
    <option value="">--</option>
    <?php
    if($result->num_rows>0){
        while ($row=$result->fetch_assoc()){
    ?>
    <option value="<?php echo $row['ItemTypeId']; ?>"><?php echo $row['ItemTypeName']; ?></option>
    <?php
        }
    }
    ?>
</select>
