<?php

use Cake\I18n\FrozenDate;

$this->layout = 'sash_dashboard';

?>


<!-- PAGE-HEADER -->
<div class="dashboard-splitter">

</div>
<!-- PAGE-HEADER END -->


<?php
$this->start('noti-marquee');

    $noti = '';
    if (count($users) > 0) {
        $noti = 'Happy Birthday: ';
        foreach ($users as $user){
            $noti = $noti . ' - '. $user->name ;
        }
    }
    
    echo $noti;

$this->end();
?>

<!-- ROW-1 -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
        <div id="carousel-prd-stat" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">

                <div class="carousel-item active">
                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                            <div class="card overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="mt-2">
                                            <h4 class="">TGT - Daily Oil Production</h4>
                                            <h1 class="mb-0 number-font"><span class="text-warning" id="tgt_daily">0</span></h1>
                                        </div>

                                    </div>
                                    <span class="stat_date text-muted fs-12"></span><span class="text-muted fs-12">(Bbbls)</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                            <div class="card overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="mt-2">
                                            <h4 class="">TGT - YTD Oil Production</h4>
                                            <h1 class="mb-0 number-font"><span class="text-blue" id="tgt_ytd">0</span></h1>
                                        </div>

                                    </div>
                                    <span class="stat_date text-muted fs-12"></span><span class="text-muted fs-12">(Bbbls)</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                            <div class="card overflow-hidden" id="tgt-achievement">
                            <!-- <canvas id="canvas"> -->
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="mt-2">
                                            <h4 class="">TGT - Yearly Target Achievement</h4>
                                            <h2 class="mb-0 number-font"><span class="text-primary" id="tgt_achive">0%</span></h2>
                                        </div>

                                    </div>
                                    <div class="progress h-2 mt-2 mb-2">
                                        <div class="progress-bar bg-primary" style="width: 79%;" id="tgt_achive_bar" role="progressbar"></div>
                                    </div>
                                </div>
                            <!-- </canvas> -->
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                            <div class="card overflow-hidden">
                                
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="mt-2">
                                            <h4 class="">TGT - Cumulative Oil Production</h4>
                                            <h1 class="mb-0 number-font"><span class="text-pink" id="tgt_total">0</span></h1>
                                        </div>

                                    </div>
                                    <span class="text-muted fs-12">Since start-up - (Bbbls)</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="carousel-item">
                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                            <div class="card overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="mt-2">
                                            <h4 class="">CNV - Daily Oil Production</h4>
                                            <h1 class="mb-0 number-font"><span class="text-warning" id="cnv_daily">0</span></h1>
                                        </div>

                                    </div>
                                    <span class="stat_date text-muted fs-12"></span><span class="text-muted fs-12">(Bbbls)</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                            <div class="card overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="mt-2">
                                            <h4 class="">CNV - YTD Oil Production</h4>
                                            <h1 class="mb-0 number-font"><span class="text-blue" id="cnv_ytd">0</span></h1>
                                        </div>

                                    </div>
                                    <span class="stat_date text-muted fs-12"></span><span class="text-muted fs-12">(Bbbls)</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                            <div class="card overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="mt-2">
                                            <h4 class="">CNV - Yearly Target Achievement</h4>
                                            <h2 class="mb-0 number-font"><span class="text-primary" id="cnv_achive">0%</span></h2>
                                        </div>

                                    </div>
                                    <div class="progress h-2 mt-2 mb-2">
                                        <div class="progress-bar bg-primary" style="width: 65%;" id="cnv_achive_bar" role="progressbar"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                            <div class="card overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="mt-2">
                                            <h4 class="">CNV - Cumulative Oil Production</h4>
                                            <h1 class="mb-0 number-font"><span class="text-pink" id="cnv_total">0</span></h1>
                                        </div>

                                    </div>
                                    <span class="text-muted fs-12">Since start-up - (Bbbls)</span>
                                </div>
                            </div>
                        </div>




                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
<!-- ROW-1 END -->

<!-- ROW-2 -->
<div class="row">
    <div class="col-xl-3">
        <div class="row">
            <div class="col-12">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="mt-2">
                                <h4 class="">Days without LTI</h4>
                                <h2 class="mb-0 number-font text-success" id="man_day">1,444,278</h2>
                            </div>
                            <div class="ms-auto">
                                <div class="chart-wrapper mt-1">
                                    <canvas id="saleschart" class="h-8 w-9 chart-dropshadow"></canvas>
                                </div>
                            </div>
                        </div>
                        <span class="text-muted fs-12" id="hse_from_date">From 2008-05-12</span>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title fw-semibold"><?= FrozenDate::now()->format('Y') ?> HSE Statistic</h3>
                    </div>
                    <div class="card-body pb-0">
                        <ul class="task-list">
                            <li class="d-sm-flex">
                                <div>
                                    <i class="task-icon bg-danger"></i>
                                    <h4 class="fw-semibold">Lost Time Injury</h4>

                                </div>
                                <div class="ms-auto d-md-flex">
                                    <h4 id="lost_time" class="text-danger">0</h4>
                                </div>
                            </li>
                            <li class="d-sm-flex">
                                <div>
                                    <i class="task-icon bg-secondary"></i>
                                    <h4 class="fw-semibold">Medical Treatment Cases</h4>
                                </div>
                                <div class="ms-auto d-md-flex">
                                    <h4 id="med_treat_case" class="text-secondary">0</h4>
                                </div>
                            </li>
                            <li class="d-sm-flex">
                                <div>
                                    <i class="task-icon bg-success"></i>
                                    <h4 class="fw-semibold">First Aid Cases</h4>

                                </div>
                                <div class="ms-auto d-md-flex">
                                    <h4 id="first_aid_case" class="text-success">1</h4>
                                </div>
                            </li>
                            <li class="d-sm-flex">
                                <div>
                                    <i class="task-icon bg-warning"></i>
                                    <h4 class="fw-semibold">Fire / Explosion</h4>

                                </div>
                                <div class="ms-auto d-md-flex">
                                    <h4 id="fire_explosion" class="text-warning">0</h4>
                                </div>
                            </li>
                            <li class="d-sm-flex">
                                <div>
                                    <i class="task-icon bg-primary"></i>
                                    <h4 class="fw-semibold">Near-miss</h4>

                                </div>
                                <div class="ms-auto d-md-flex">
                                    <h4 id="near_miss" class="text-primary">5</h4>
                                </div>
                            </li>
                            <!-- <li class="d-sm-flex">
                                <div>
                                    <i class="task-icon bg-info"></i>
                                    <h4 class="fw-semibold">Observation Cards</h4>

                                </div>
                                <div class="ms-auto d-md-flex">
                                    <h4 id="obs_card">5</h4>
                                </div>
                            </li> -->

                        </ul>
                    </div>
                </div>
            </div>
            
<!-- ------ giá dầu ------>
            <div class="col-12">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="text-warning">Brent Crude</div>
                                <div class="text-secondary">WTI Crude</div>
                                <div class="text-primary">USD</div>
                            </div>
                            <div class="col-6">
                                <div class="text-end text-warning" id="brent_price">85.92</div>
                                <div class="text-end text-secondary" id="wti_price">83.45</div>
                                <div class="text-end text-primary" id="usd_vnd">23456.1</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<!-- ------ End giá dầu ------>

        </div>
    </div>

    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9">
        <div id="carousel-chart" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner active">

                <div class="carousel-item active">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">

                                <div class="card-header">
                                    <h3 class="card-title">TGT Production Trend</h3>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex mx-auto text-center justify-content-center mb-4">
                                        
                                        <div class="d-flex text-center justify-content-center"><span class="dot-label bg-secondary my-auto"></span>TGT Daily Oil Rate</div>
                                    </div>
                                    <div class="chartjs-wrapper-demo">
                                        <canvas id="tgt-transactions" class="chart-dropshadow"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">

                                <div class="card-header">
                                    <h3 class="card-title">CNV Production Trend</h3>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex mx-auto text-center justify-content-center mb-4">
                                        <div class="d-flex text-center justify-content-center me-3"><span class="dot-label bg-primary my-auto"></span>CNV Daily Oil Rate</div>
                                        
                                    </div>
                                    <div class="chartjs-wrapper-demo">
                                        <canvas id="cnv-transactions" class="chart-dropshadow"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div id="carousel-picture" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">

                        <div class="carousel-item active">
                            <div class="card">
                                <div class="row">
                                    <div class="col-lg-4"><?= $this->Html->image('../uploads/dashboard/slide1.jpg', ['class' => 'img-responsive br-5', 'alt' => 'slide1']) ?></div>
                                    <div class="col-lg-4"><?= $this->Html->image('../uploads/dashboard/slide2.jpg', ['class' => 'img-responsive br-5', 'alt' => 'slide2']) ?></div>
                                    <div class="col-lg-4"><?= $this->Html->image('../uploads/dashboard/slide3.jpg', ['class' => 'img-responsive br-5', 'alt' => 'slide3']) ?></div>
                                </div>
                            </div>
                        </div>


                        <div class="carousel-item ">
                            <div class="card">
                                <div class="row">
                                    <div class="col-lg-4"><?= $this->Html->image('../uploads/dashboard/slide4.jpg', ['class' => 'img-responsive br-5', 'alt' => 'slide4']) ?></div>
                                    <div class="col-lg-4"><?= $this->Html->image('../uploads/dashboard/slide5.jpg', ['class' => 'img-responsive br-5', 'alt' => 'slide5']) ?></div>
                                    <div class="col-lg-4"><?= $this->Html->image('../uploads/dashboard/slide6.jpg', ['class' => 'img-responsive br-5', 'alt' => 'slide6']) ?></div>
                                </div>
                            </div>
                        </div>


                        <div class="carousel-item ">
                            <div class="card">
                                <div class="row">
                                    <div class="col-lg-4"><?= $this->Html->image('../uploads/dashboard/slide7.jpg', ['class' => 'img-responsive br-5', 'alt' => 'slide7']) ?></div>
                                    <div class="col-lg-4"><?= $this->Html->image('../uploads/dashboard/slide8.jpg', ['class' => 'img-responsive br-5', 'alt' => 'slide8']) ?></div>
                                    <div class="col-lg-4"><?= $this->Html->image('../uploads/dashboard/slide9.jpg', ['class' => 'img-responsive br-5', 'alt' => 'slide9']) ?></div>
                                </div>
                            </div>
                        </div>


                        <div class="carousel-item ">
                            <div class="card">
                                <div class="row">
                                    <div class="col-lg-4"><?= $this->Html->image('../uploads/dashboard/venguon1.jpg', ['class' => 'img-responsive br-5', 'alt' => 'slide']) ?></div>
                                    <div class="col-lg-4"><?= $this->Html->image('../uploads/dashboard/venguon2.jpg', ['class' => 'img-responsive br-5', 'alt' => 'slide']) ?></div>
                                    <div class="col-lg-4"><?= $this->Html->image('../uploads/dashboard/venguon3.jpg', ['class' => 'img-responsive br-5', 'alt' => 'slide']) ?></div>
                                </div>
                            </div>
                        </div>

                        <div class="carousel-item ">
                            <div class="card">
                                <div class="row">
                                    <div class="col-lg-4"><?= $this->Html->image('../uploads/dashboard/donate1.jpg', ['class' => 'img-responsive br-5', 'alt' => 'slide']) ?></div>
                                    <div class="col-lg-4"><?= $this->Html->image('../uploads/dashboard/donate2.jpg', ['class' => 'img-responsive br-5', 'alt' => 'slide']) ?></div>
                                    <div class="col-lg-4"><?= $this->Html->image('../uploads/dashboard/donate3.jpg', ['class' => 'img-responsive br-5', 'alt' => 'slide']) ?></div>
                                </div>
                            </div>
                        </div>

                        <div class="carousel-item ">
                            <div class="card">
                                <div class="row">
                                    <div class="col-lg-4"><?= $this->Html->image('../uploads/dashboard/women1.jpg', ['class' => 'img-responsive br-5', 'alt' => 'slide']) ?></div>
                                    <div class="col-lg-4"><?= $this->Html->image('../uploads/dashboard/women2.jpg', ['class' => 'img-responsive br-5', 'alt' => 'slide']) ?></div>
                                    <div class="col-lg-4"><?= $this->Html->image('../uploads/dashboard/women3.jpg', ['class' => 'img-responsive br-5', 'alt' => 'slide']) ?></div>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="carousel-item active">
                            <div class="card">
                                <div class="row">
                                    <div class="col-lg-4"><?= $this->Html->image('../uploads/2010/pn1.jpg', ['class' => 'img-responsive br-5', 'alt' => 'slide1']) ?></div>
                                    <div class="col-lg-4"><?= $this->Html->image('../uploads/2010/pn2.jpg', ['class' => 'img-responsive br-5', 'alt' => 'slide2']) ?></div>
                                    <div class="col-lg-4"><?= $this->Html->image('../uploads/2010/pn3.jpg', ['class' => 'img-responsive br-5', 'alt' => 'slide3']) ?></div>
                                </div>
                            </div>
                        </div>


                        <div class="carousel-item ">
                            <div class="card">
                                <div class="row">
                                    <div class="col-lg-4"><?= $this->Html->image('../uploads/2010/pn4.jpg', ['class' => 'img-responsive br-5', 'alt' => 'slide4']) ?></div>
                                    <div class="col-lg-4"><?= $this->Html->image('../uploads/2010/pn5.jpg', ['class' => 'img-responsive br-5', 'alt' => 'slide5']) ?></div>
                                    <div class="col-lg-4"><?= $this->Html->image('../uploads/2010/pn6.jpg', ['class' => 'img-responsive br-5', 'alt' => 'slide6']) ?></div>
                                </div>
                            </div>
                        </div> -->


                        
                    </div>
                </div>
            </div>
        </div>

        

    </div>


</div>

<!-- ROW-2 END -->