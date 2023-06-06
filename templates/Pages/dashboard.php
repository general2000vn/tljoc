<?php
$this->layout = 'sash_dashboard';

?>


<!-- PAGE-HEADER -->
<div class="page-header">

</div>
<!-- PAGE-HEADER END -->

<!-- ROW-1 -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="mt-2">
                                <h6 class="">Man-Hours without LTI</h6>
                                <h2 class="mb-0 number-font">1,444,278</h2>
                            </div>
                            <div class="ms-auto">
                                <div class="chart-wrapper mt-1">
                                    <canvas id="saleschart" class="h-8 w-9 chart-dropshadow"></canvas>
                                </div>
                            </div>
                        </div>
                        <span class="text-muted fs-12"><span class="text-secondary"><i class="fe fe-arrow-up-circle  text-secondary"></i> 5%</span>
                            Last week</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="mt-2">
                                <h6 class="">Oil Rate - TGT</h6>
                                <h2 class="mb-0 number-font">25,987</h2>
                            </div>
                            <div class="ms-auto">
                                <div class="chart-wrapper mt-1">
                                    <canvas id="leadschart" class="h-8 w-9 chart-dropshadow"></canvas>
                                </div>
                            </div>
                        </div>
                        <span class="text-muted fs-12"><span class="text-pink"><i class="fe fe-arrow-down-circle text-pink"></i> 0.75%</span>
                            Last 7 days</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="mt-2">
                                <h6 class="">Oil Rate - CNV</h6>
                                <h2 class="mb-0 number-font">16,654</h2>
                            </div>
                            <div class="ms-auto">
                                <div class="chart-wrapper mt-1">
                                    <canvas id="costchart" class="h-8 w-9 chart-dropshadow"></canvas>
                                </div>
                            </div>
                        </div>
                        <span class="text-muted fs-12"><span class="text-warning"><i class="fe fe-arrow-up-circle text-warning"></i> 0.6%</span>
                            Last 7 days</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="mt-2">
                                <h6 class="">Total Production (barrels)</h6>
                                <h2 class="mb-0 number-font">100,376,965</h2>
                            </div>
                            <div class="ms-auto">
                                <div class="chart-wrapper mt-1">
                                    <canvas id="profitchart" class="h-8 w-9 chart-dropshadow"></canvas>
                                </div>
                            </div>
                        </div>
                        <span class="text-muted fs-12"><span class="text-green"><i class="fe fe-arrow-up-circle text-green"></i> 0.9%</span>
                            Last 9 days</span>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
<!-- ROW-1 END -->

<!-- ROW-2 -->
<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Production Analytics</h3>
            </div>
            <div class="card-body">
                <div class="d-flex mx-auto text-center justify-content-center mb-4">
                    <div class="d-flex text-center justify-content-center me-3"><span class="dot-label bg-primary my-auto"></span>Oil Rate</div>
                    <div class="d-flex text-center justify-content-center"><span class="dot-label bg-secondary my-auto"></span>Gas Rate</div>
                </div>
                <div class="chartjs-wrapper-demo">
                    <canvas id="transactions" class="chart-dropshadow"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title fw-semibold">Recent Activity</h4>
            </div>
            <div class="card-body pb-0">
                <ul class="task-list">
                    <li class="d-sm-flex">
                        <div>
                            <i class="task-icon bg-primary"></i>
                            <h6 class="fw-semibold">Well Test Comleted<span class="text-muted fs-11 mx-2 fw-normal">09 Sep 2022</span>
                            </h6>
                            <p class="text-muted fs-12">Well test data is reported for<a href="javascript:void(0)" class="fw-semibold"> TGT-H1-4PST1</a></p>
                        </div>
                        <div class="ms-auto d-md-flex">
                            <a href="javascript:void(0)" class="text-muted me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" aria-label="Edit"><span class="fe fe-edit"></span></a>
                            <a href="javascript:void(0)" class="text-muted"><span class="fe fe-trash-2"></span></a>
                        </div>
                    </li>
                    <li class="d-sm-flex">
                        <div>
                            <i class="task-icon bg-secondary"></i>
                            <h6 class="fw-semibold">Drilling Campaign Update<span class="text-muted fs-11 mx-2 fw-normal">08 Sep 2022</span>
                            </h6>
                            <p class="text-muted fs-12">Naga3 rig is moved to dedicated position in <a href="javascript:void(0)" class="fw-semibold"> H5 site</a></p>
                        </div>
                        <div class="ms-auto d-md-flex">
                            <a href="javascript:void(0)" class="text-muted me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" aria-label="Edit"><span class="fe fe-edit"></span></a>
                            <a href="javascript:void(0)" class="text-muted"><span class="fe fe-trash-2"></span></a>
                        </div>
                    </li>
                    <li class="d-sm-flex">
                        <div>
                            <i class="task-icon bg-success"></i>
                            <h6 class="fw-semibold">HSE Announcement<span class="text-muted fs-11 mx-2 fw-normal">25 Aug 2022</span>
                            </h6>
                            <p class="text-muted fs-12">All staff keep recording Covid-19 test results and vaccination on<a href="javascript:void(0)" class="fw-semibold"> E-Office</a></p>
                        </div>
                        <div class="ms-auto d-md-flex">
                            <a href="javascript:void(0)" class="text-muted me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" aria-label="Edit"><span class="fe fe-edit"></span></a>
                            <a href="javascript:void(0)" class="text-muted"><span class="fe fe-trash-2"></span></a>
                        </div>
                    </li>
                    <li class="d-sm-flex">
                        <div>
                            <i class="task-icon bg-warning"></i>
                            <h6 class="fw-semibold">Notice<span class="text-muted fs-11 mx-2 fw-normal">14 June 2022</span>
                            </h6>
                            <p class="text-muted mb-0 fs-12">This dashboard currently showing test data<a href="javascript:void(0)" class="fw-semibold"> for testing purposes</a></p>
                        </div>
                        <div class="ms-auto d-md-flex">
                            <a href="javascript:void(0)" class="text-muted me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" aria-label="Edit"><span class="fe fe-edit"></span></a>
                            <a href="javascript:void(0)" class="text-muted"><span class="fe fe-trash-2"></span></a>
                        </div>
                    </li>
                    <li class="d-sm-flex">
                        <div>
                            <i class="task-icon bg-danger"></i>
                            <h6 class="fw-semibold">Task Overdue<span class="text-muted fs-11 mx-2 fw-normal">29 June 2021</span>
                            </h6>
                            <p class="text-muted mb-0 fs-12">Petey Cruiser finished task <a href="javascript:void(0)" class="fw-semibold"> Integrated management</a></p>
                        </div>
                        <div class="ms-auto d-md-flex">
                            <a href="javascript:void(0)" class="text-muted me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" aria-label="Edit"><span class="fe fe-edit"></span></a>
                            <a href="javascript:void(0)" class="text-muted"><span class="fe fe-trash-2"></span></a>
                        </div>
                    </li>
                    <li class="d-sm-flex">
                        <div>
                            <i class="task-icon bg-info"></i>
                            <h6 class="fw-semibold">Task Finished<span class="text-muted fs-11 mx-2 fw-normal">09 July 2021</span>
                            </h6>
                            <p class="text-muted fs-12">Adam Berry finished task on<a href="javascript:void(0)" class="fw-semibold"> Project Management</a></p>
                        </div>
                        <div class="ms-auto d-md-flex">
                            <a href="javascript:void(0)" class="text-muted me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" aria-label="Edit"><span class="fe fe-edit"></span></a>
                            <a href="javascript:void(0)" class="text-muted"><span class="fe fe-trash-2"></span></a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- ROW-2 END -->