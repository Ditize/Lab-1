<?php
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `products` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=stripslashes($v);
        }
    }
}
?>
<div class="card card-outline card-info">
	<div class="card-header">
		<h3 class="card-title"><?php echo isset($id) ? "Update ": "Create New " ?> Product</h3>
	</div>
	<div class="card-body">
		<form action="" id="product-form">
			<input type="hidden" name ="id" value="<?php echo isset($id) ? $id : '' ?>">
            <div class="form-group">
				<label for="category_id" class="control-label">Category</label>
                <select name="category_id" id="category_id" class="custom-select select2" required>
                <option value=""></option>
                <?php
                    $qry = $conn->query("SELECT * FROM `categories` order by category asc");
                    while($row= $qry->fetch_assoc()):
                ?>
                <option value="<?php echo $row['id'] ?>" <?php echo isset($category_id) && $category_id == $row['id'] ? 'selected' : '' ?>><?php echo $row['category'] ?></option>
                <?php endwhile; ?>
                </select>
			</div>
            <div class="form-group">
				<label for="sub_category_id" class="control-label">Sub Category</label>
                <select name="sub_category_id" id="sub_category_id" class="custom-select" required>
                <option value="" selected="" disabled="">Select Category First</option>
                <?php
                    $qry = $conn->query("SELECT * FROM `sub_categories` order by sub_category asc");
                    $sub_categories = array();
                    while($row= $qry->fetch_assoc()):
                    $sub_categories[$row['parent_id']][] = $row;
                    endwhile; 
                ?>
                </select>
			</div>
            <div class="form-group">
				<label for="title" class="control-label">Book Title</label>
                <textarea name="title" id="" cols="30" rows="2" class="form-control form no-resize"><?php echo isset($title) ? $title : ''; ?></textarea>
			</div>
			<div class="form-group">
            <label for="author" class="control-label">Authors</label>
                <small>(<i>Use comma (,) for seperating the name of Authors</i>)</small>
                <textarea name="author" id="" cols="30" rows="2" class="form-control form no-resize"><?php echo isset($author) ? $author : ''; ?></textarea>
			</div>
            <div class="form-group">
				<label for="description" class="control-label">Description</label>
                <textarea name="description" id="" cols="30" rows="2" class="form-control form no-resize summernote"><?php echo isset($description) ? $description : ''; ?></textarea>
			</div>
            <div class="form-group">
				<label for="status" class="control-label">Status</label>
                <select name="status" id="status" class="custom-select selevt">
                <option value="1" <?php echo isset($status) && $status == 1 ? 'selected' : '' ?>>Active</option>
                <option value="0" <?php echo isset($status) && $status == 0 ? 'selected' : '' ?>>Inactive</option>
                </select>
			</div>
            <div class="form-group">
				<label for="" class="control-label">Images</label>
				<div class="custom-file">
	              <input type="file" class="custom-file-input rounded-circle" id="customFile" name="img[]" multiple accept="image/*" onchange="displayImg(this,$(this))">
	              <label class="custom-file-label" for="customFile">Choose file</label>
	            </div>
			</div>
            <?php 
            if(isset($id)):
            $upload_path = "uploads/product_".$id;
            if(is_dir(base_app.$upload_path)): 
            ?>
            <?php 
            
                $file= scandir(base_app.$upload_path);
                foreach($file as $img):
                    if(in_array($img,array('.','..')))
                        continue;
                    
                
            ?>