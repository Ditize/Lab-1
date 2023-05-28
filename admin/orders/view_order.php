<div class="card card-outline card-primary">
    <div class="card-body">
        <div class="conitaner-fluid">
            <p><b>Client Name: <?php echo $client ?></b></p>
            <?php if($order_type == 1): ?>
            <p><b>Delivery Address: <?php echo $delivery_address ?></b></p>
            <?php endif; ?>
            <table class="table-striped table table-bordered">
                <colgroup>
                    <col width="15%">
                    <col width="35%">
                    <col width="25%">
                    <col width="25%">
                </colgroup>
                <thead>
                    <tr>
                        <th>QTY</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>