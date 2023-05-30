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
                <?php 
                        $olist = $conn->query("SELECT o.*,p.title,p.author FROM order_list o inner join products p on o.product_id = p.id where o.order_id = '{$id}' ");
                        while($row = $olist->fetch_assoc()):
                        foreach($row as $k => $v){
                            $row[$k] = trim(stripslashes($v));
                        }
                    ?>
                    <tr>
                        <td><?php echo $row['quantity'] ?></td>
                        <td>
                            <p class="m-0"><?php echo $row['title']?></p>
                            <p class="m-0"><small>Author: <?php echo $row['author']?></small></p>
                           
                        </td>
                        <td class="text-right"><?php echo number_format($row['price']) ?></td>
                        <td class="text-right"><?php echo number_format($row['price'] * $row['quantity']) ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>