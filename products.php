<?php 
$title= "";
$sub_title= "";
if(isset($GET['c']) && isset($_GET['s'])){
    $cat_qry = $conn->query("SELECT * FROM categories where md5(id) = '{$_GET['c']}'");
    if($cat_qry->num_rows > 0){
        $result =$cat_qry->fetch_assoc();
        $title =$result['category'];
        $cat_descript= $result['description'];
    }
$sub_cat_qry = $conn->query("SELECT * FROM sub_categories where md5(id)= '{$_GET['s']}'");
  if($sub_cat_qry->num_row > 0 ){
    $result =$cat_qry->fetch_assoc();
    $title =$result['category'];
    $cat_descript= $result['description'];
  }
}
elseif(isset($_GET['c'])){
    $cat_qry = $conn->query("SELECT * FROM categories where md5(id) = '{$_GET['c']}'");
    if($cat_qry->num_rows > 0){
        $result =$cat_qry->fetch_assoc();
        $title =$result['category'];
        $cat_descript= $result['description'];
    }  
}
elseif(isset($_GET['s'])){
    $sub_cat_qry = $conn->query("SELECT * FROM sub_categories where md5(id)= '{$_GET['s']}'");
  if($sub_cat_qry->num_row > 0 ){
    $result =$cat_qry->fetch_assoc();
    $title =$result['category'];
    $cat_descript= $result['description'];
  }
}
?>
<!--Header-->
<header class="bg-dark py-5" id="main-header">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder"><?php echo $title ?></h1>
             <p class="lead fw-normal text-white-50 mb-0"><?php echo $sub_title ?></p>
        </div>
    </div>
</header>  
<!--Section-->
<section class="py-5">
    <div class="container-fluid row">
        <?php if(isset($_GET['c'])): ?>
        <div class="col-md-3 border-right mb-2 pb-3">
            <h3><b>Sub Categories</b></h3>
            <div class="list-group">
                <a href="./?p=products&c=<?php echo $_GET['c'] ?>" class="list-group-item <?php echo !isset($_GET['s']) ? "active" : "" ?>">All</a>
                <?php 
                $sub_cat = $conn->query("SELECT * FROM `sub_categories` where md5(parent_id) =  '{$_GET['c']}' ");
                while($row = $sub_cat->fetch_assoc()):
                ?>
                    <a href="./?p=products&c=<?php echo $_GET['c'] ?>&s=<?php echo md5($row['id']) ?>" class="list-group-item  <?php echo isset($_GET['s']) && $_GET['s'] == md5($row['id']) ? "active" : "" ?>"><?php echo $row['sub_category'] ?></a>
                <?php endwhile; ?>
            </div>
            <hr>
        </div>
        <?php endif; ?>
        <div class="<?php echo isset($_GET['c'])? 'col-md-9': 'col-md-10 offset-md-1' ?>">
            <div class="container-fluid p-0">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="book-tab" data-toggle="tab" href="#book" role="tab" aria-controls="book" aria-selected="true">Books</a>
                </li>
                <?php if(isset($_GET['c'])): ?>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="details-tab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="false">Details</a>
                </li>
                <?php endif; ?>
            </ul>
            <div class="tab-content pt-2">
                <div class="tab-pane fade show active" id="book">
                    <?php 
                            if(isset($_GET['search'])){
                                echo "<h4 class='text-center'><b>Search Result for '".$_GET['search']."'</b></h4>";
                            }
                        ?>