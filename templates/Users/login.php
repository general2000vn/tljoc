<?php
    $this->layout = 'unauthenticated';
    $this->set('title', 'Login');
?>

<div class="authentication">
    <div class="container">
        
        <div class="row">
            <div class="col-lg-4 col-sm-12">
                <!-- <form class="card auth_form"> -->
                <?= $this->Form->create(null, ['class'=>"card auth_form", 'url' => ['action' => 'login']]) ?>
                    <div class="header">
                        <!-- <img class="logo" src="assets/images/logo.svg" alt=""> -->
                        <?= $this->Html->image("branding/TLJOC_logo_large.png", ['class' => 'logo']) ?>
                        <!-- <?= $this->Html->image("branding/TLJOC_logo_large.png", ['class' => '']) ?> -->
                        <!-- <?= $this->Html->image("branding/TLJOC_logo_medium.png", ['class' => '']) ?> -->
                        
                        <h5>e-Office</h5>
                        
                        <?= $this->Form->hidden('origin', ['value' => $origin]) ?>
                        
                    </div>
                    <div class="body">
                        <div class="input-group mb-3">
                            <input name="username" type="text" class="form-control" placeholder="Username">
                            <!-- <?= $this->Form->control('username', ['class' => 'form-control', 'type' => 'text', 'placeholder' => 'Username']) ?> -->
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="zmdi zmdi-account-circle"></i></span>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                             <input name="password" type="password" class="form-control" placeholder="Password"> 
                            <!--<?= $this->Form->control('password', ['class' => 'form-control', 'type' => 'text', 'placeholder' => 'Password']) ?>-->
                            <div class="input-group-append">                                
                                <span class="input-group-text"><a href="forgot-password.html" class="forgot" title="Forgot Password"><i class="zmdi zmdi-lock"></i></a></span>
                            </div>                            
                        </div>
                        
                        <!--
                        <div class="checkbox">
                            <input type="hidden" name="remember_me" value="0">
                            <input id="remember-me" value="1" name="remember_me" type="checkbox">
                            <label for="remember-me">Remember Me</label>
                        </div>
                        -->
                        
                        
                        
                        <?= $this->Form->submit("SIGN IN", ['class' => 'btn btn-primary btn-block waves-effect waves-light']) ?>
                        <div class="signin_with mt-3">
                            <p class="mb-0">Sign in using your TLJOC accounts.</p>
                            
                        </div>
                    </div>
                <?= $this->Form->end() ?>
                <!-- </form> -->
                <div class="copyright text-center">
                    &copy;
                    <script>document.write(new Date().getFullYear())</script>,
                    <span>Developed by <strong>Luton</strong></span>
                </div>
            </div>
            <div class="col-lg-8 col-sm-12">
                <div class="card">
                    <!-- <img src="assets/images/signin.svg" alt="Sign In"/> -->
                    <?= $this->Html->image("../assets/images/signin.svg", ['alt' => 'Sign In']) ?>
                </div>
            </div>
        </div>
    </div>
</div>