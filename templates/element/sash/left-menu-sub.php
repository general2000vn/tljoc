        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                </svg></div>
            <ul class="side-menu">
                <li class="sub-category">
                    <h3>Main</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="<?= $this->Url->build('/', ['fullBase' => false]) ?>"><i class="side-menu__icon fe fe-home"></i><span class="side-menu__label">Home</span></a>
                </li>
                <li class="sub-category">
                    <h3>SUBSURFACE</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fe fe-slack"></i><span class="side-menu__label">Plot Reports</span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu">
                        <li class="side-menu-label1"><a href="javascript:void(0)">Plot Reports</a></li>
                        <li class="sub-slide">
                            <a class="sub-side-menu__item" data-bs-toggle="sub-slide" href="javascript:void(0)"><span class="sub-side-menu__label">Well Tests</span><i class="sub-angle fe fe-chevron-right"></i></a>
                            <ul class="sub-slide-menu">
                                <li><a href="<?= $this->Url->build('/sub-reports/view/1', ['fullBase' => false]) ?>" class="sub-slide-item"> H1-4PS</a></li>
                                <li><a href="<?= $this->Url->build('/sub-reports/view/2', ['fullBase' => false]) ?>" class="sub-slide-item"> H4-4PS</a></li>
                                <li><a href="<?= $this->Url->build('/sub-reports/view/3', ['fullBase' => false]) ?>" class="sub-slide-item"> H5-4PS</a></li>
                            </ul>
                        </li>
                        <li class="sub-slide">
                            <a class="sub-side-menu__item" data-bs-toggle="sub-slide" href="javascript:void(0)"><span class="sub-side-menu__label">Actual Rate</span><i class="sub-angle fe fe-chevron-right"></i></a>
                            <ul class="sub-slide-menu">
                                <li><a href="<?= $this->Url->build('/sub-reports/performance/1', ['fullBase' => false]) ?>" class="sub-slide-item"> H1-4PS</a></li>
                                <li><a href="<?= $this->Url->build('/sub-reports/performance/2', ['fullBase' => false]) ?>" class="sub-slide-item"> H4-4PS</a></li>
                                <li><a href="<?= $this->Url->build('/sub-reports/performance/3', ['fullBase' => false]) ?>" class="sub-slide-item"> H5-4PS</a></li>
                            </ul>
                        </li>


                    </ul>
                </li>


            </ul>


            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                </svg></div>
        </div>