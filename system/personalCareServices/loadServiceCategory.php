<?php
include '../function.php';

$ServiceTypeId=$_POST['ServiceTypeId'];
$db= dbConn();
$sql="SELECT * FROM tbl_personal_care_services_category WHERE ServiceTypeId='$ServiceTypeId'";
$result=$db->query($sql);
?>
<select class="form-control" name="ServiceCategoryId" id="ServiceCategoryId">
    <option value="">--</option>
    <?php
    if($result->num_rows>0){
        while ($row=$result->fetch_assoc()){
    ?>
    <option value="<?php echo $row['ServiceCategoryId']; ?>"><?php echo $row['ServiceCategoryName']; ?></option>
    <?php
        }
    }
    ?>
</select>

