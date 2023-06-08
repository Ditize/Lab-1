<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<?php 
$total = 0;
    $qry = $conn->query("SELECT c.*,p.title,i.price,p.id as pid from `cart` c inner join `inventory` i on i.id=c.inventory_id inner join products p on p.id = i.product_id where c.client_id = ".$_settings->userdata('id'));
    while($row= $qry->fetch_assoc()):
        $total += $row['price'] * $row['quantity'];
    endwhile;
?>
