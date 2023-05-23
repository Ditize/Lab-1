<?php
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `inventory` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
?>
<div class="card card-outline card-info">
	<div class="card-header">
		<h3 class="card-title"><?php echo isset($id) ? "Update ": "Create New " ?> Inventory</h3>
	</div>
	<div class="card-body">
		<form action="" id="inventory-form">
			<input type="hidden" name ="id" value="<?php echo isset($id) ? $id : '' ?>">
			<div class="form-group">
				<label for="product_id" class="control-label">Product</label>
                <select name="product_id" id="product_id" class="custom-select select2" required>
                    <option value=""></option>
                    <?php
                        $qry = $conn->query("SELECT * FROM `products` order by title asc");
                        while($row= $qry->fetch_assoc()):
                            foreach($row as $k=> $v){
								$row[$k] = trim(stripslashes($v));
							}
                    ?>
                    <option value="<?php echo $row['id'] ?>" <?php echo isset($product_id) && $product_id == $row['id'] ? 'selected' : '' ?>><?php echo $row['title'] ?></option>
                    <?php endwhile; ?>
                </select>