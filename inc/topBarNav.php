<nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid px-4 px-lg-5 ">
                <button class="navbar-toggler btn btn-sm" type="button" 
                data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                 aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <a class="navbar-brand" href="./">
                <img src="<?php echo validate_image($_settings->info('logo')) ?>" width="35" height="35" 
                class="d-inline-block align-top" alt="" loading="lazy">
                <?php echo $_settings->info('short_name') ?>
                </a>

                <form class="form-inline" id="search-form">
                  <div class="input-group">
                    <input class="form-control form-control-sm form " type="search" placeholder="Search" aria-label="Search" name="search"
                      value="<?php echo isset($_GET['search']) ? $_GET['search'] : "" ?>"  aria-describedby="button-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-outline-success btn-sm m-0" type="submit" id="button-addon2"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                </form>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link" aria-current="page" href="./">Home</a></li>
                        <?php 
                        $cat_qry = $conn->query("SELECT * FROM categories where status = 1  limit 3");
                        $count_cats =$conn->query("SELECT * FROM categories where status = 1 ")->num_rows;
                        while($crow = $cat_qry->fetch_assoc()):
                          $sub_qry = $conn->query("SELECT * FROM sub_categories where status = 1 and parent_id = '{$crow['id']}'");
                          if($sub_qry->num_rows <= 0):
                        ?>
                        <li class="nav-item"><a class="nav-link" aria-current="page" href="./?p=products&c=<?php echo md5($crow['id']) ?>"><?php echo $crow['category'] ?></a></li>