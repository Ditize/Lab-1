<style>
    #uni_modal .modal-content>.modal-footer,#uni_modal .modal-content>.modal-header{
        display:none;
    }
</style>
<div class="container-fluid">
    
    <div class="row">
    <h3 class="float-right">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </h3>
        <div class="col-lg-12">
            <h3 class="text-center">Login</h3>
            <hr>
            <form action="" id="login-form">
                <div class="form-group">
                    <label for="" class="control-label">Email</label>
                    <input type="email" class="form-control form" name="email" required>
                </div>
                <div class="form-group">
                    <label for="" class="control-label">Password</label>
                    <input type="password" class="form-control form" name="password" required>
                </div>
                <div class="form-group d-flex justify-content-between">
                    <a href="javascript:void()" id="create_account">Create Account</a>
                    <button class="btn btn-primary btn-flat">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>