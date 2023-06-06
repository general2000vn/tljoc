<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<?php
    //$this->layout = 'styleless';
?>

<?php


$page_heading = 'Edit Profile';

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => 'Users', 'class' => 'active'],
    ['caption' => $page_heading, 'class' => 'active'],
]);

$this->start('head_css');
    echo $this->Html->css('../assets/plugins/bootstrap-select/css/bootstrap-select');
$this->end();

$this->start('head_scripts');
//echo $this->Html->css(['../assets/plugins/bootstrap/css/bootstrap.min', '../assets/css/style.min']) ;
$this->end();

$this->start('bottom_scripts');

$this->end();

?>
<!-- First Row Avatar and account info-->
<div class="row clearfix">
    <div class="col-lg-4 col-md-12">
        <div class="card mcard_3">
            <div class="body">
                
                <?= $this->Html->image($user->picture, ['class' => "rounded-circle shadow", 'alt' => 'Profile Image']) ?>
                <h4 class="m-t-10"><?= $user->username ?></h4>
<!--
                <div class="row">
                    <div class="col-12">
                        <ul class="social-links list-unstyled">
                            <li><a title="facebook" href="javascript:void(0);"><i class="zmdi zmdi-facebook"></i></a></li>
                            <li><a title="twitter" href="javascript:void(0);"><i class="zmdi zmdi-twitter"></i></a></li>
                            <li><a title="instagram" href="javascript:void(0);"><i class="zmdi zmdi-instagram"></i></a></li>
                        </ul>
                        <p class="text-muted">795 Folsom Ave, Suite 600 San Francisco, CADGE 94107</p>
                    </div>
                    <div class="col-4">
                        <small>Following</small>
                        <h5>852</h5>
                    </div>
                    <div class="col-4">
                        <small>Followers</small>
                        <h5>13k</h5>
                    </div>
                    <div class="col-4">
                        <small>Post</small>
                        <h5>234</h5>
                    </div>
                </div>
-->
            </div>
        </div>
        <div class="card">
        <div class="header">
                <h2><strong>Roles</strong> : </h2>
            </div>
            <div class="body">
                
                <ul class="list-unstyled">
                    <?php foreach ($user->roles as $role): ?>
                    <li>
                        <div><?= $role->name ?></div>
                        
                    </li>
                    <?php endforeach; ?>
                </ul>
                
            </div>
        </div>
    </div>

    <div class="col-lg-8 col-md-12">
        <div class="card">
            <div class="header">
                <h2><strong>Account</strong> Detail</h2>
            </div>
            <div class="body">
                <?= $this->Form->create($user) ?>
                <div class="row clearfix">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?= $this->Form->control('firstname',['class' => 'form-control', 'disabled']) ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?= $this->Form->control('lastname',['class' => 'form-control', 'disabled']) ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?= $this->Form->control('email',['class' => 'form-control', 'disabled']) ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?= $this->Form->control('group_id',['label' => 'Department','class' => 'form-control', 'disabled']) ?>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                        <?php 
                                $this->Form->setTemplates([
                                    'nestingLabel' => '{{hidden}}{{input}}<label{{attrs}}>{{text}}</label>',
                                    'formGroup' => '{{label}}{{input}}',
                                ]);
                            ?>
                            
                            <?= $this->Form->control('is_active',['class' => 'form-control']) ?>
                        </div>
                    </div>
                    
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <?= $this->Form->control('mobile',['class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?= $this->Form->control('id_number',['class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?= $this->Form->control('id_date',['class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?= $this->Form->control('id_issuer',['class' => 'form-control']) ?>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <?= $this->Form->label('vaccination_id', 'Vaccination Status') ?>
                            <?= $this->Form->select('vaccination_id',$vaccinations,['class' => 'form-control']) ?>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <?= $this->Form->label('health_id', 'Health Status') ?>  
                            <?= $this->Form->select('health_id',$healths,['class' => 'form-control', 'aria-label' => 'Default select example']) ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <?= $this->Form->label('vaccine1_id', '1st Vaccine') ?>  
                            <?= $this->Form->select('vaccine1_id',$vaccines,['class' => 'form-control', 'aria-label' => 'Default select example', 'empty' => "-none-"]) ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <?= $this->Form->control('vaccine1_date',['label' => '1st Vaccine Date','class' => 'form-control']) ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <?= $this->Form->control('vaccine1_place',['label' => '1st Vaccine Place','class' => 'form-control']) ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <?= $this->Form->label('vaccine2_id', '2nd Vaccine') ?>  
                            <?= $this->Form->select('vaccine2_id',$vaccines,['class' => 'form-control', 'aria-label' => 'Default select example', 'empty' => "-none-"]) ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <?= $this->Form->control('vaccine2_date',['label' => '2nd Vaccine Date','class' => 'form-control']) ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <?= $this->Form->control('vaccine2_place',['label' => '2nd Vaccine Place','class' => 'form-control']) ?>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="form-group">
                            <?= $this->Form->control('addr_detail',['label' => 'Address','class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?= $this->Form->control('addr_city',['label' => 'City','class' => 'form-control']) ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <?= $this->Form->control('addr_district',['label' => 'District','class' => 'form-control']) ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <?= $this->Form->control('addr_ward',['label' => 'Ward','class' => 'form-control']) ?>
                        </div>
                    </div>

                    <div class="col-md-12 align-center">
                        <button class="btn btn-primary">Save Changes</button>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>

</div>

<!-- Reset Password 
<div class="row-clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2><strong>Security</strong> Settings</h2>
            </div>
            <div class="body">
                <?= $this->Form->create($user, ['url'=> ['action' => 'changePassword']]) ?>
                <div class="row">
                    <div class="col-lg-4 col-md-12">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Current Password">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="New Password">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Confirm Password">
                        </div>
                    </div>
                    <div class="col-12 align-center">
                        <button class="btn btn-primary">Save Changes</button>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
-->