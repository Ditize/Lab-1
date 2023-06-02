<div class="container-fluid">
    <form id="status-update-form">
        <input type="hidden" name="id" value="<?php echo $_GET['oid'] ?>">
        <div class="form-group">
            <label for="" class="control-label">Status</label>
            <select name="status" id="" class="custom-select custol-select-sm">
                <option value="0" <?php echo $_GET['status'] == 0 ? "selected" : '' ?>>Pending</option>
                <option value="1" <?php echo $_GET['status'] == 1 ? "selected" : '' ?>>Packed</option>
                <option value="2" <?php echo $_GET['status'] == 2 ? "selected" : '' ?>>Out for Delivery</option>
                <option value="5" <?php echo $_GET['status'] == 5 ? "selected" : '' ?>>Picked Up</option>
                <option value="3" <?php echo $_GET['status'] == 3 ? "selected" : '' ?>>Delivered</option>
                <option value="4" <?php echo $_GET['status'] == 4 ? "selected" : '' ?>>Cancelled</option>
            </select>
        </div>
    </form>
</div>