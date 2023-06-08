<?php
$this->layout = 'sash_login';
?>



<div class="panel-body tabs-menu-body p-0 pt-5">
    <div class="tab-content">
        <div class="tab-pane active" id="tab5">
            <div class="wrap-input100 validate-input input-group" data-bs-validate="Valid email is required: ex@abc.xyz">
                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                    <i class="fa fa-user-circle text-muted" aria-hidden="true"></i>
                </a>
                <input class="input100 border-start-0 form-control ms-0" type="text" placeholder="Username" name="username">
            </div>
            <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                    <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                </a>
                <input class="input100 border-start-0 form-control ms-0" type="password" placeholder="Password" name="password">
            </div>

            <div class="container-login100-form-btn">
                <a href="index.html" class="login100-form-btn btn-primary">
                    Login
                </a>
            </div>
            <div class="text-center pt-3">
                <p class="text-dark mb-0">Please enter your TLJOC account to log in!</p>
            </div>

        </div>

    </div>
</div>