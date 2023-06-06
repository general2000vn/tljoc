<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AbcCampaign $abcCampaign
 * @var \Cake\Collection\CollectionInterface|string[] $abcStatuses
 * @var \Cake\Collection\CollectionInterface|AbcCategory[] $abcCategories
 */

$page_heading = 'Create Annual Business Compliance campaign';

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => $this->Html->link('HR', ['controller' => 'AbcCampaigns', 'action' => 'blank']), 'class' => ""],
    ['caption' => $this->Html->link('Annual Business Compliance', ['controller' => 'AbcCampaigns', 'action' => 'index']), 'class' => ""],
    ['caption' => $page_heading, 'class' => 'active'],
]);

$this->start('head_css');
$this->end();

$this->start('head_scripts');
$this->end();

$this->start('bottom_scripts');
echo $this->Html->script(['../themes/sash/assets/plugins/select2/select2.full.min', '../themes/sash/assets/js/select2']);
//echo $this->Html->script(['../themes/sash/assets/plugins/fileuploads/js/fileupload', '../themes/sash/assets/plugins/fileuploads/js/file-upload']);
$this->end();

$this->loadHelper('Form', [
    'templates' => 'sash_form_templates',
]);
?>



<?= $this->Form->create($abcCampaign) ?>

<div class="row">
    <div class="col-md-12">

        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Campaign information</h3>
            </div>
            <div class="card-body">

                <div class="row">

                    <?php

                    echo $this->Form->control('period', ['label' => 'Year', 'type' => 'year', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('deadline', ['label' => 'Deadline', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('abc_status_id', ['disabled', 'options' => $abcStatuses, 'templateVars' => ['ctnClass' => 'col-md-4']]);
                    ?>

                </div>
            </div>
        </div>

        <?php
        $cat = 1;
        $i = 0;
        ?>

        <div class="card">

            <div class="card-header">

                <h3 class="card-title"><?= $abcCategories[$cat - 1]->en ?></h3>
            </div>
            <div class="card-body">
                <div>

                    <div id="item_list_<?= $cat ?>">

                        <div class="row" id="item-<?= $i ?>-">
                            <?= $this->Form->hidden('abc_questions.' . $i . '.abc_category_id', ['value' => $cat]) ?>
                            <div class="col-md-2">
                                <div class="row">
                                    <?= $this->Form->control('abc_questions.' . $i . '.order_code', ['required','label' => false, 'value' => '1.1', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="form-label">Abnormal Answer</div>
                                        <?= $this->Form->radio('abc_questions.' . $i . '.abnormal', [['value' => 0, 'text' => 'No', 'checked'], ['value' => true, 'text' => 'Yes']], ['required', 'class' => 'custom-control-input', 'templateVars' => ['ctnClass' => 'custom-control custom-radio-md']]) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <?= $this->Form->control('abc_questions.' . $i . '.vn', ['required', 'label' => false, 'rows' => 3, 'value' => 'Bạn đã đọc Quy trình và Chính sách Nhân viên và Quy trình Mua sắm và Hợp đồng và Chính sách & Quy trình Bảo mật, Đạo đức kinh doanh chưa?', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                    <?= $this->Form->control('abc_questions.' . $i . '.en', ['required', 'label' => false, 'rows' => 3, 'value' => 'Have you read the Hoang Long - Hoan Vu JOC\'s Staff Policy, Employee Procedures, the Contract and Procurement Procedures and Confidentiality Business Ethics Policy & Procedures? ', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                </div>
                            </div>
                            <?php $i++; ?>
                        </div>
                        <br />
                        <br />


                        <div class="row" id="item-<?= $i ?>-">
                            <?= $this->Form->hidden('abc_questions.' . $i . '.abc_category_id', ['value' => $cat]) ?>
                            <div class="col-md-2">
                                <div class="row">
                                    <?= $this->Form->control('abc_questions.' . $i . '.order_code', ['required', 'label' => false, 'value' => '1.2', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="form-label">Abnormal Answer</div>

                                        <?= $this->Form->radio('abc_questions.' . $i . '.abnormal', [['value' => 0, 'text' => 'No', 'checked'], ['value' => true, 'text' => 'Yes']], ['required', 'class' => 'custom-control-input', 'templateVars' => ['ctnClass' => 'custom-control custom-radio-md']]) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <?= $this->Form->control('abc_questions.' . $i . '.vn', ['required', 'label' => false, 'rows' => 3, 'value' => 'Trong 2 năm vừa qua, bạn đã tham gia các tập huấn hoặc dự hội thảo về Chính sách Đạo đức Kinh doanh hoặc đã được nghe giải thích về các yêu cầu của Công ty về việc Hối lộ?', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                    <?= $this->Form->control('abc_questions.' . $i . '.en', ['required', 'label' => false, 'rows' => 3, 'value' => 'Have you, in the last two years, undertaken any training or attended any workshops on the Business Ethics Policy or have the JOC\'s expectations with regard to Bribery been explained to you?', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                </div>
                            </div>
                            <?php $i++; ?>
                        </div>
                        <br />
                        <br />


                    </div>

                </div>
            </div>

            <?php $cat++; ?>
        </div>

<!--

        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?= $abcCategories[$cat - 1]->en ?></h3>
            </div>
            <div class="card-body">
                <div>

                    <div id="item_list_<?= $cat ?>">

                        <div class="row" id="item-<?= $i ?>-">
                            <?= $this->Form->hidden('abc_questions.' . $i . '.abc_category_id', ['value' => $cat]) ?>
                            <div class="col-md-2">
                                <div class="row">
                                    <?= $this->Form->control('abc_questions.' . $i . '.order_code', ['required', 'label' => false, 'value' => '2.1', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="form-label">Abnormal Answer</div>
                                        <?= $this->Form->radio('abc_questions.' . $i . '.abnormal', [['value' => 0, 'text' => 'No'], ['value' => 1, 'text' => 'Yes', 'checked']], ['required', 'class' => 'custom-control-input', 'templateVars' => ['ctnClass' => 'custom-control custom-radio-md']]) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <?= $this->Form->control('abc_questions.' . $i . '.vn', ['required', 'label' => false, 'rows' => 3, 'value' => 'Bạn đã tặng quà, dành những ưu đãi hoặc giải trí cho những người khác (1) không phù hợp thực tiễn kinh doanh thông thường, (2) vượt quá giá trị và/hoặc có thể bị xem là hối lộ hoặc lót tay, (3) vi phạm luật pháp hoặc chuẩn mực đạo đức hoặc (4) nếu bị tiết lộ thông tin có gây ảnh hưởng đến Công ty hoặc chính bạn?', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                    <?= $this->Form->control('abc_questions.' . $i . '.en', ['required', 'label' => false, 'rows' => 3, 'value' => 'Have you given any gifts, favors or entertainment to others that were (1) not consistent with customary business practice, (2) excessive in value and/or could be construed as a bribe or pay-off, (3) in violation of applicable laws or ethical standards, or (4) such that public disclosure could embarrass the Company or yourself? ', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                </div>
                            </div>
                            <?php $i++; ?>
                        </div>
                        <br />
                        <br />


                        <div class="row" id="item-<?= $i ?>-">
                            <?= $this->Form->hidden('abc_questions.' . $i . '.abc_category_id', ['value' => $cat]) ?>
                            <div class="col-md-2">
                                <div class="row">
                                    <?= $this->Form->control('abc_questions.' . $i . '.order_code', ['required', 'label' => false, 'value' => '2.2', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="form-label">Abnormal Answer</div>

                                        <?= $this->Form->radio('abc_questions.' . $i . '.abnormal', [['value' => 0, 'text' => 'No'], ['value' => 1, 'text' => 'Yes', 'checked']], ['required', 'class' => 'custom-control-input', 'templateVars' => ['ctnClass' => 'custom-control custom-radio-md']]) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <?= $this->Form->control('abc_questions.' . $i . '.vn', ['required', 'label' => false, 'rows' => 3, 'value' => 'Bạn đã từng trả tiền hoặc đồng ý bất cứ hoa hồng, hạ giá, giảm giá, cho nợ hoặc trợ cấp liên quan đến việc mua bán của Công ty (1) mà được ghi chép trong sổ sách của một công ty khác ngoài công ty ghi nhận việc mua bán, (2) không dẫn tới một sự tương xứng hợp lý giữa giá trị  hàng hoá được giao hoặc dịch vụ nhận được, (3) được trả bằng tiền mặt hoặc được trả cho các doanh nghiệp kinh doanh không liên quan đến việc mua bán, hoặc (4) được thực hiện tại một quốc gia không phải địa điểm kinh doanh của tổ chức đó?', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                    <?= $this->Form->control('abc_questions.' . $i . '.en', ['required', 'label' => false, 'rows' => 3, 'value' => 'Have you paid or granted any commissions, rebates, discounts, credits, or allowances in connection with sales by the Company that (1) are to be recorded on the books of a company other than the company reporting the sale, (2) do not bear a reasonable relationship to the value of goods delivered or services rendered, (3) were paid in cash or were paid to other than the specific business entity making the purchases, or (4) were made in a country that is not the entity\'s place of business? ', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                </div>
                            </div>
                            <?php $i++; ?>
                        </div>
                        <br />
                        <br />


                        <div class="row" id="item-<?= $i ?>-">
                            <?= $this->Form->hidden('abc_questions.' . $i . '.abc_category_id', ['value' => $cat]) ?>
                            <div class="col-md-2">
                                <div class="row">
                                    <?= $this->Form->control('abc_questions.' . $i . '.order_code', ['required', 'label' => false, 'value' => '2.3', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="form-label">Abnormal Answer</div>
                                        <?= $this->Form->radio('abc_questions.' . $i . '.abnormal', [['value' => 0, 'text' => 'No'], ['value' => 1, 'text' => 'Yes', 'checked']], ['required', 'class' => 'custom-control-input', 'templateVars' => ['ctnClass' => 'custom-control custom-radio-md']]) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <?= $this->Form->control('abc_questions.' . $i . '.vn', ['required', 'label' => false, 'rows' => 3, 'value' => 'Bạn đã từng tặng quà, ưu đãi, trả tiền mặt hoặc tương đương với tiền mặt cho bất cứ quan chức, đại diện hoặc nhân viên của bất cứ nhà nước hoặc ban ngành, cơ quan nào để được hỗ trợ, xúc tiến hoặc gây ảnh hưởng đến hành động, quyết định hoặc sự bỏ qua của bất cứ quan chức nhà nước, quan chức hoặc ứng cử viên của đảng phái chính trị, với khả năng quyền hạn của họ mà có liên quan đến hoạt động của Công ty?', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                    <?= $this->Form->control('abc_questions.' . $i . '.en', ['required', 'label' => false, 'rows' => 3, 'value' => 'Have you given any gifts, favors, entertainment, cash or cash equivalents to any official, agent or employee of any government or any department, agency to facilitate, expedite or influence the act, decision or omission of any government official, political party official or candidate, in his or its official capacity in connection with the performance of the Company business?', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                </div>
                            </div>
                            <?php $i++; ?>
                        </div>
                        <br />
                        <br />


                        <div class="row" id="item-<?= $i ?>-">
                            <?= $this->Form->hidden('abc_questions.' . $i . '.abc_category_id', ['value' => $cat]) ?>
                            <div class="col-md-2">
                                <div class="row">
                                    <?= $this->Form->control('abc_questions.' . $i . '.order_code', ['required', 'label' => false, 'value' => '2.4', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="form-label">Abnormal Answer</div>

                                        <?= $this->Form->radio('abc_questions.' . $i . '.abnormal', [['value' => 0, 'text' => 'No', 'checked'], ['value' => true, 'text' => 'Yes']], ['required', 'class' => 'custom-control-input', 'templateVars' => ['ctnClass' => 'custom-control custom-radio-md']]) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <?= $this->Form->control('abc_questions.' . $i . '.vn', ['required', 'label' => false, 'rows' => 3, 'value' => 'Bạn có biết các quy định chặt chẽ khi làm việc với các cơ quan và viên chức nhà nước, và do tính chất nhạy cảm của các mối quan hệ này, bạn đã nói chuyện với cấp trên trực tiếp trước khi đề nghị hoặc tặng quà hay sự hiếu khách cho viên chức nhà nước? ', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                    <?= $this->Form->control('abc_questions.' . $i . '.en', ['required', 'label' => false, 'rows' => 3, 'value' => 'Are you aware of the strict rules applied when we do business with governmental agencies and officials, and because of the sensitive nature of these relationships, have talked with your direct supervisor before offering or making any gifts or hospitality to government employees?', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                </div>
                            </div>
                            <?php $i++; ?>
                        </div>
                        <br />
                        <br />


                        <?php $cat++; ?>
                    </div>

                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?= $abcCategories[$cat - 1]->en ?></h3>
            </div>
            <div class="card-body">
                <div>

                    <div id="item_list_<?= $cat ?>">

                        <div class="row" id="item-<?= $i ?>-">
                            <?= $this->Form->hidden('abc_questions.' . $i . '.abc_category_id', ['value' => $cat]) ?>
                            <div class="col-md-2">
                                <div class="row">
                                    <?= $this->Form->control('abc_questions.' . $i . '.order_code', ['required', 'label' => false, 'value' => '3.1', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="form-label">Abnormal Answer</div>
                                        <?= $this->Form->radio('abc_questions.' . $i . '.abnormal', [['value' => 0, 'text' => 'No'], ['value' => 1, 'text' => 'Yes', 'checked']], ['required', 'class' => 'custom-control-input', 'templateVars' => ['ctnClass' => 'custom-control custom-radio-md']]) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <?= $this->Form->control('abc_questions.' . $i . '.vn', ['required', 'label' => false, 'rows' => 3, 'value' => 'Bạn đã bao giờ đề nghị hoặc nhận quà, ưu đãi hoặc các giải trí cho mình hoặc người khác mà mục đích công việc không hợp pháp, ngoài phép lịch sự thông thường theo thực tiễn hoạt động kinh doanh?', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                    <?= $this->Form->control('abc_questions.' . $i . '.en', ['required', 'label' => false, 'rows' => 3, 'value' => 'Have you sought or accepted for yourself or others any gifts, favors or entertainment without a legitimate business purpose, other than common courtesies usually associated with customary business practice?', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                </div>
                            </div>
                            <?php $i++; ?>
                        </div>
                        <br />
                        <br />


                        <div class="row" id="item-<?= $i ?>-">
                            <?= $this->Form->hidden('abc_questions.' . $i . '.abc_category_id', ['value' => $cat]) ?>
                            <div class="col-md-2">
                                <div class="row">
                                    <?= $this->Form->control('abc_questions.' . $i . '.order_code', ['required', 'label' => false, 'value' => '3.2', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="form-label">Abnormal Answer</div>

                                        <?= $this->Form->radio('abc_questions.' . $i . '.abnormal', [['value' => 0, 'text' => 'No'], ['value' => 1, 'text' => 'Yes', 'checked']], ['required', 'class' => 'custom-control-input', 'templateVars' => ['ctnClass' => 'custom-control custom-radio-md']]) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <?= $this->Form->control('abc_questions.' . $i . '.vn', ['required', 'label' => false, 'rows' => 3, 'value' => 'Bạn đã bao giờ nhận cho bạn hay người khác các khoản tiền mặt, hiện vật tương đương tiền mặt hay khoản vay (ngoài các khoản vay chính thức theo lãi suất trên thị trường) từ các cá nhân hoặc tổ chức kinh doanh đang muốn hợp tác hoặc là đối thủ của Công ty?', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                    <?= $this->Form->control('abc_questions.' . $i . '.en', ['required', 'label' => false, 'rows' => 3, 'value' => 'Have you accepted for yourself or others any cash, cash equivalents, or loans (other than conventional loans at market rates) from any person or business organisation that does or seeks to do business with or is a competitor of the Company?', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                </div>
                            </div>
                            <?php $i++; ?>
                        </div>
                        <br />
                        <br />


                        <?php $cat++; ?>
                    </div>

                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?= $abcCategories[$cat - 1]->en ?></h3>
            </div>
            <div class="card-body">
                <div>

                    <div id="item_list_<?= $cat ?>">

                        <div class="row" id="item-<?= $i ?>-">
                            <?= $this->Form->hidden('abc_questions.' . $i . '.abc_category_id', ['value' => $cat]) ?>
                            <div class="col-md-2">
                                <div class="row">
                                    <?= $this->Form->control('abc_questions.' . $i . '.order_code', ['required', 'label' => false, 'value' => '4.1', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="form-label">Abnormal Answer</div>
                                        <?= $this->Form->radio('abc_questions.' . $i . '.abnormal', [['value' => 0, 'text' => 'No'], ['value' => 1, 'text' => 'Yes', 'checked']], ['required', 'class' => 'custom-control-input', 'templateVars' => ['ctnClass' => 'custom-control custom-radio-md']]) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <?= $this->Form->control('abc_questions.' . $i . '.vn', ['required', 'label' => false, 'rows' => 3, 'value' => 'Trong sự hiểu biết của mình, bạn hoặc một thành viên khác trong gia đình có lợi ích tài chính quan trọng ở một công ty khác đang làm việc hoặc đang muốn hợp tác kinh doanh hoặc là đối thủ của Công ty không?', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                    <?= $this->Form->control('abc_questions.' . $i . '.en', ['required', 'label' => false, 'rows' => 3, 'value' => 'Do you or, to your knowledge, a member of your family have a significant financial interest in any outside enterprise which seeks to do business with or is a competitor of the Company?', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                </div>
                            </div>
                            <?php $i++; ?>
                        </div>
                        <br />
                        <br />


                        <div class="row" id="item-<?= $i ?>-">
                            <?= $this->Form->hidden('abc_questions.' . $i . '.abc_category_id', ['value' => $cat]) ?>
                            <div class="col-md-2">
                                <div class="row">
                                    <?= $this->Form->control('abc_questions.' . $i . '.order_code', ['required', 'label' => false, 'value' => '4.2', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="form-label">Abnormal Answer</div>

                                        <?= $this->Form->radio('abc_questions.' . $i . '.abnormal', [['value' => 0, 'text' => 'No'], ['value' => 1, 'text' => 'Yes', 'checked']], ['required', 'class' => 'custom-control-input', 'templateVars' => ['ctnClass' => 'custom-control custom-radio-md']]) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <?= $this->Form->control('abc_questions.' . $i . '.vn', ['required', 'label' => false, 'rows' => 3, 'value' => 'Bạn có đang là giám đốc, nhân viên, đối tác, cố vấn hoặc nhân viên của một công ty khác đang làm việc hay đang muốn hợp tác kinh doanh, hoặc là đối thủ của Công ty không?', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                    <?= $this->Form->control('abc_questions.' . $i . '.en', ['required', 'label' => false, 'rows' => 3, 'value' => 'Are you serving as a director, officer, partner, consultant or employee of any outside enterprise which does or seeks to do business with or is a competitor of the Company?', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                </div>
                            </div>
                            <?php $i++; ?>
                        </div>
                        <br />
                        <br />


                        <div class="row" id="item-<?= $i ?>-">
                            <?= $this->Form->hidden('abc_questions.' . $i . '.abc_category_id', ['value' => $cat]) ?>
                            <div class="col-md-2">
                                <div class="row">
                                    <?= $this->Form->control('abc_questions.' . $i . '.order_code', ['required', 'label' => false, 'value' => '4.3', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="form-label">Abnormal Answer</div>
                                        <?= $this->Form->radio('abc_questions.' . $i . '.abnormal', [['value' => 0, 'text' => 'No'], ['value' => 1, 'text' => 'Yes', 'checked']], ['required', 'class' => 'custom-control-input', 'templateVars' => ['ctnClass' => 'custom-control custom-radio-md']]) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <?= $this->Form->control('abc_questions.' . $i . '.vn', ['required', 'label' => false, 'rows' => 3, 'value' => 'Bạn có đang là môi giới, trung gian hoặc đại diện cho một bên thứ ba trong các giao dịch liên quan hoặc có thể liên quan đến Công ty không?', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                    <?= $this->Form->control('abc_questions.' . $i . '.en', ['required', 'label' => false, 'rows' => 3, 'value' => 'Are you acting as a broker, finder, go-between for the benefit, or on behalf of a third party in transactions involving or potentially involving the Company?', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                </div>
                            </div>
                            <?php $i++; ?>
                        </div>
                        <br />
                        <br />


                        <div class="row" id="item-<?= $i ?>-">
                            <?= $this->Form->hidden('abc_questions.' . $i . '.abc_category_id', ['value' => $cat]) ?>
                            <div class="col-md-2">
                                <div class="row">
                                    <?= $this->Form->control('abc_questions.' . $i . '.order_code', ['required', 'label' => false, 'value' => '4.4', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="form-label">Abnormal Answer</div>

                                        <?= $this->Form->radio('abc_questions.' . $i . '.abnormal', [['value' => 0, 'text' => 'No'], ['value' => 1, 'text' => 'Yes', 'checked']], ['required', 'class' => 'custom-control-input', 'templateVars' => ['ctnClass' => 'custom-control custom-radio-md']]) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <?= $this->Form->control('abc_questions.' . $i . '.vn', ['required', 'label' => false, 'rows' => 3, 'value' => 'Bạn có người thân có giữ chức vụ trong các cơ quan nhà nước hoặc là giám đốc, nhân viên, cố vấn, tư vấn, đại lý hoặc thành viên quản trị của bất cứ tổ chức nào đang làm việc hay đang muốn hợp tác với Công ty không?', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                    <?= $this->Form->control('abc_questions.' . $i . '.en', ['required', 'label' => false, 'rows' => 3, 'value' => 'Do any of your close relatives hold any position in governance bodies or serve as a director, employee, advisor, consultant, agent or trustee for any entity that does business or seeks to do business with the Company?', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                </div>
                            </div>
                            <?php $i++; ?>
                        </div>
                        <br />
                        <br />


                        <div class="row" id="item-<?= $i ?>-">
                            <?= $this->Form->hidden('abc_questions.' . $i . '.abc_category_id', ['value' => $cat]) ?>
                            <div class="col-md-2">
                                <div class="row">
                                    <?= $this->Form->control('abc_questions.' . $i . '.order_code', ['required', 'label' => false, 'value' => '4.5', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="form-label">Abnormal Answer</div>

                                        <?= $this->Form->radio('abc_questions.' . $i . '.abnormal', [['value' => 0, 'text' => 'No'], ['value' => 1, 'text' => 'Yes', 'checked']], ['required', 'class' => 'custom-control-input', 'templateVars' => ['ctnClass' => 'custom-control custom-radio-md']]) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <?= $this->Form->control('abc_questions.' . $i . '.vn', ['required', 'label' => false, 'rows' => 3, 'value' => 'Bạn có người thân đang làm việc với Công ty với tư cách là nhà cung cấp, khách hàng, nhà thầu, đại lý, cố vấn hoặc tư vấn không?', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                    <?= $this->Form->control('abc_questions.' . $i . '.en', ['required', 'label' => false, 'rows' => 3, 'value' => 'Do any of your close relatives work with the Company as suppliers, customers, contractors, agents, advisors or consultants?', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                </div>
                            </div>
                            <?php $i++; ?>
                        </div>
                        <br />
                        <br />


                        <div class="row" id="item-<?= $i ?>-">
                            <?= $this->Form->hidden('abc_questions.' . $i . '.abc_category_id', ['value' => $cat]) ?>
                            <div class="col-md-2">
                                <div class="row">
                                    <?= $this->Form->control('abc_questions.' . $i . '.order_code', ['required', 'label' => false, 'value' => '4.6', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="form-label">Abnormal Answer</div>
                                        <?= $this->Form->radio('abc_questions.' . $i . '.abnormal', [['value' => 0, 'text' => 'No'], ['value' => 1, 'text' => 'Yes', 'checked']], ['required', 'class' => 'custom-control-input', 'templateVars' => ['ctnClass' => 'custom-control custom-radio-md']]) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <?= $this->Form->control('abc_questions.' . $i . '.vn', ['required', 'label' => false, 'rows' => 3, 'value' => 'Bạn có tham gia vào bất cứ việc dàn xếp, hoặc trong các tình huống nào liên quan đến quan hệ gia đình hoặc cá nhân, mà có thể khiến bạn không làm việc vì lợi ích cao nhất của Công ty?', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                    <?= $this->Form->control('abc_questions.' . $i . '.en', ['required', 'label' => false, 'rows' => 3, 'value' => 'Are you involved in any arrangement or circumstances, including family or other personal relationships, which might discourage you from acting in the best interest of the Company?', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                </div>
                            </div>
                            <?php $i++; ?>
                        </div>
                        <br />
                        <br />

                        <div class="row" id="item-<?= $i ?>-">
                            <?= $this->Form->hidden('abc_questions.' . $i . '.abc_category_id', ['value' => $cat]) ?>
                            <div class="col-md-2">
                                <div class="row">
                                    <?= $this->Form->control('abc_questions.' . $i . '.order_code', ['required', 'label' => false, 'value' => '4.7', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="form-label">Abnormal Answer</div>

                                        <?= $this->Form->radio('abc_questions.' . $i . '.abnormal', [['value' => 0, 'text' => 'No'], ['value' => 1, 'text' => 'Yes', 'checked']], ['required', 'class' => 'custom-control-input', 'templateVars' => ['ctnClass' => 'custom-control custom-radio-md']]) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <?= $this->Form->control('abc_questions.' . $i . '.vn', ['required', 'label' => false, 'rows' => 3, 'value' => 'Bạn có đang cạnh tranh với Công ty trong hoạt động dầu khí hoặc bạn đã sử dụng thông tin hoặc thiết bị của Công ty để trực tiếp hoặc gián tiếp làm lợi cho mình bằng việc đạt được tài sản, quyền thuê dầu khí, tài nguyên hoặc các quyền lợi khoáng sản không?', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                    <?= $this->Form->control('abc_questions.' . $i . '.en', ['required', 'label' => false, 'rows' => 3, 'value' => 'Are you competing with the Company in oil and gas operations or did you use Company information or equipment to profit you directly or indirectly by acquiring property, oil or gas leases, royalties or mineral interests?', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                </div>
                            </div>
                            <?php $i++; ?>
                        </div>
                        <br />
                        <br />


                        <div class="row" id="item-<?= $i ?>-">
                            <?= $this->Form->hidden('abc_questions.' . $i . '.abc_category_id', ['value' => $cat]) ?>
                            <div class="col-md-2">
                                <div class="row">
                                    <?= $this->Form->control('abc_questions.' . $i . '.order_code', ['required', 'label' => false, 'value' => '4.8', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="form-label">Abnormal Answer</div>

                                        <?= $this->Form->radio('abc_questions.' . $i . '.abnormal', [['value' => 0, 'text' => 'No', 'checked'], ['value' => true, 'text' => 'Yes']], ['required', 'class' => 'custom-control-input', 'templateVars' => ['ctnClass' => 'custom-control custom-radio-md']]) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <?= $this->Form->control('abc_questions.' . $i . '.vn', ['required', 'label' => false, 'rows' => 3, 'value' => 'Bạn có biết rằng bất cứ hành động nào mà có thể liên quan đến xung đột lợi ích, hoặc xuất hiện khả năng xung đột lợi ích, cần phải được báo cáo đầy đủ bằng văn bản cho Trưởng Phòng, Tổng Giám đốc và Phó Tổng Giám đốc để xem xét và phê duyệt ngay khi xung đột phát sinh? Nhân viên nào biết mà không báo cáo xung đột lợi ích sẽ bị xem xét xử lý kỷ luật, bao gồm cả việc sa thải.', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                    <?= $this->Form->control('abc_questions.' . $i . '.en', ['required', 'label' => false, 'rows' => 3, 'value' => 'Are you aware that any actions that might involve a conflict of interest, or the appearance of a potential conflict of interest, should be fully disclosed in writing to your Department Manager, the General Manager and Deputy General Manager for review and approval as soon as the conflict occurs? Employees who knowingly fail to disclose conflicts are subject to discipline, including dismissal.', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                </div>
                            </div>
                            <?php $i++; ?>
                        </div>
                        <br />
                        <br />


                        <div class="row" id="item-<?= $i ?>-">
                            <?= $this->Form->hidden('abc_questions.' . $i . '.abc_category_id', ['value' => $cat]) ?>
                            <div class="col-md-2">
                                <div class="row">
                                    <?= $this->Form->control('abc_questions.' . $i . '.order_code', ['required', 'label' => false, 'value' => '4.9', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="form-label">Abnormal Answer</div>

                                        <?= $this->Form->radio('abc_questions.' . $i . '.abnormal', [['value' => 0, 'text' => 'No'], ['value' => 1, 'text' => 'Yes', 'checked']], ['required', 'class' => 'custom-control-input', 'templateVars' => ['ctnClass' => 'custom-control custom-radio-md']]) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <?= $this->Form->control('abc_questions.' . $i . '.vn', ['required', 'label' => false, 'rows' => 3, 'value' => 'Ngoài trách nhiệm của bạn với tư cách là nhân viên của Công ty, được thực hiện cho và thay mặt Công ty, bạn có từng thực hiện những công việc dịch vụ nào cho hoặc thay mặt cho Bên Hợp đồngmà chưa báo cáo về thời gian sẽ được tính cho Bên Hợp đồng đó?', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                    <?= $this->Form->control('abc_questions.' . $i . '.en', ['required', 'label' => false, 'rows' => 3, 'value' => 'In addition to your duties as an Employee of the Company, which are performed for and on behalf of the Company, have you performed any services for or on behalf of a Contractor Party that you have not reported as time to be charged to that Contractor Party?', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                </div>
                            </div>
                            <?php $i++; ?>
                        </div>
                        <br />
                        <br />

                        <?php $cat++; ?>
                    </div>

                </div>
            </div>
        </div>

        <div class="card">

            <div class="card-header">

                <h3 class="card-title"><?= $abcCategories[$cat - 1]->en ?></h3>
            </div>
            <div class="card-body">
                <div>

                    <div id="item_list_<?= $cat ?>">

                        <div class="row" id="item-<?= $i ?>-">
                            <?= $this->Form->hidden('abc_questions.' . $i . '.abc_category_id', ['value' => $cat]) ?>
                            <div class="col-md-2">
                                <div class="row">
                                    <?= $this->Form->control('abc_questions.' . $i . '.order_code', ['required','label' => false, 'value' => '5.1', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="form-label">Abnormal Answer</div>
                                        <?= $this->Form->radio('abc_questions.' . $i . '.abnormal', [['value' => 0, 'text' => 'No'], ['value' => 1, 'text' => 'Yes', 'checked']], ['required', 'class' => 'custom-control-input', 'templateVars' => ['ctnClass' => 'custom-control custom-radio-md']]) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <?= $this->Form->control('abc_questions.' . $i . '.vn', ['required', 'label' => false, 'rows' => 3, 'value' => 'Bạn có sử dụng thông tin hoặc dữ liệu bảo mật của công ty cho mục đích lợi ích của cá nhân hoặc của người khác (bao gồm giao dịch chứng khoán) và/hoặc tiết lộ thông tin hoặc dữ liệu bảo mật cho người khác mà không được sự phê duyệt theo thẩm quyền?', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                    <?= $this->Form->control('abc_questions.' . $i . '.en', ['required', 'label' => false, 'rows' => 3, 'value' => 'Have you used confidential data or information for your personal or someone else\'s gain (including securities trading/stock exchange) and/or released confidential data or information to others without proper authorisation?', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                </div>
                            </div>
                            <?php $i++; ?>
                        </div>
                        <br />
                        <br />

                    </div>

                </div>
            </div>

            <?php $cat++; ?>
        </div>

        <div class="card">

            <div class="card-header">

                <h3 class="card-title"><?= $abcCategories[$cat - 1]->en ?></h3>
            </div>
            <div class="card-body">
                <div>

                    <div id="item_list_<?= $cat ?>">

                        <div class="row" id="item-<?= $i ?>-">
                            <?= $this->Form->hidden('abc_questions.' . $i . '.abc_category_id', ['value' => $cat]) ?>
                            <div class="col-md-2">
                                <div class="row">
                                    <?= $this->Form->control('abc_questions.' . $i . '.order_code', ['required','label' => false, 'value' => '6.1', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="form-label">Abnormal Answer</div>
                                        <?= $this->Form->radio('abc_questions.' . $i . '.abnormal', [['value' => 0, 'text' => 'No'], ['value' => 1, 'text' => 'Yes', 'checked']], ['required', 'class' => 'custom-control-input', 'templateVars' => ['ctnClass' => 'custom-control custom-radio-md']]) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <?= $this->Form->control('abc_questions.' . $i . '.vn', ['required', 'label' => false, 'rows' => 3, 'value' => 'Bạn có từng dùng các quỹ, tài sản hoặc dịch vụ của Công ty đóng góp cho một đảng phái chính trị hoặc uỷ ban, trong nước hay ngoài nước, hoặc cho ứng cử viên hoặc người đứng đầu các cơ quan nhà nước?', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                    <?= $this->Form->control('abc_questions.' . $i . '.en', ['required', 'label' => false, 'rows' => 3, 'value' => 'Have you made a contribution of Company funds, property or services to a political party or committee, domestic or foreign, or to a candidate for or holder of any government office?', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                </div>
                            </div>
                            <?php $i++; ?>
                        </div>
                        <br />
                        <br />

                    </div>

                </div>
            </div>

            <?php $cat++; ?>
        </div>

        <div class="card">

            <div class="card-header">

                <h3 class="card-title"><?= $abcCategories[$cat - 1]->en ?></h3>
            </div>
            <div class="card-body">
                <div>

                    <div id="item_list_<?= $cat ?>">

                        <div class="row" id="item-<?= $i ?>-">
                            <?= $this->Form->hidden('abc_questions.' . $i . '.abc_category_id', ['value' => $cat]) ?>
                            <div class="col-md-2">
                                <div class="row">
                                    <?= $this->Form->control('abc_questions.' . $i . '.order_code', ['required','label' => false, 'value' => '7.1', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="form-label">Abnormal Answer</div>
                                        <?= $this->Form->radio('abc_questions.' . $i . '.abnormal', [['value' => 0, 'text' => 'No'], ['value' => 1, 'text' => 'Yes', 'checked']], ['required', 'class' => 'custom-control-input', 'templateVars' => ['ctnClass' => 'custom-control custom-radio-md']]) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <?= $this->Form->control('abc_questions.' . $i . '.vn', ['required', 'label' => false, 'rows' => 3, 'value' => 'Dưới nhiều phương thức, bạn có từng thực hiện sổ sách kế toán hoặc các ghi chép khác của Công ty không phản ánh rõ ràng và không ghi nhận bản chất và thời gian hoạt động, giao dịch kinh doanh của Công ty?', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                    <?= $this->Form->control('abc_questions.' . $i . '.en', ['required', 'label' => false, 'rows' => 3, 'value' => 'Have you in any way caused the Company\'s accounts or other records to not clearly describe and properly state the true nature and timing of a business activity or transaction?', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                </div>
                            </div>
                            <?php $i++; ?>
                        </div>
                        <br />
                        <br />


                        <div class="row" id="item-<?= $i ?>-">
                            <?= $this->Form->hidden('abc_questions.' . $i . '.abc_category_id', ['value' => $cat]) ?>
                            <div class="col-md-2">
                                <div class="row">
                                    <?= $this->Form->control('abc_questions.' . $i . '.order_code', ['required', 'label' => false, 'value' => '7.2', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="form-label">Abnormal Answer</div>

                                        <?= $this->Form->radio('abc_questions.' . $i . '.abnormal', [['value' => 0, 'text' => 'No', 'checked'], ['value' => true, 'text' => 'Yes']], ['required', 'class' => 'custom-control-input', 'templateVars' => ['ctnClass' => 'custom-control custom-radio-md']]) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <?= $this->Form->control('abc_questions.' . $i . '.vn', ['required', 'label' => false, 'rows' => 3, 'value' => 'Bạn có hiểu rằng các ghi chép kế toán và tài liệu hỗ trợ có thể xem tương tự như quà tặng, ưu đãi, cho những người khác cần phải ghi chép chính xác, bao gồm các diễn giải nội dung phù hợp, rõ ràng?', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                    <?= $this->Form->control('abc_questions.' . $i . '.en', ['required', 'label' => false, 'rows' => 3, 'value' => 'Have you understood that accounting records and supporting documentation reflecting gifts, favors and entertainment to others must be accurately stated, including appropriate, clear, descriptive text?', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                </div>
                            </div>
                            <?php $i++; ?>
                        </div>
                        <br />
                        <br />


                    </div>

                </div>
            </div>

            <?php $cat++; ?>
        </div>

        <div class="card">

            <div class="card-header">

                <h3 class="card-title"><?= $abcCategories[$cat - 1]->en ?></h3>
            </div>
            <div class="card-body">
                <div>

                    <div id="item_list_<?= $cat ?>">

                        <div class="row" id="item-<?= $i ?>-">
                            <?= $this->Form->hidden('abc_questions.' . $i . '.abc_category_id', ['value' => $cat]) ?>
                            <div class="col-md-2">
                                <div class="row">
                                    <?= $this->Form->control('abc_questions.' . $i . '.order_code', ['required','label' => false, 'value' => '8.1', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="form-label">Abnormal Answer</div>
                                        <?= $this->Form->radio('abc_questions.' . $i . '.abnormal', [['value' => 0, 'text' => 'No', 'checked'], ['value' => true, 'text' => 'Yes']], ['required', 'class' => 'custom-control-input', 'templateVars' => ['ctnClass' => 'custom-control custom-radio-md']]) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <?= $this->Form->control('abc_questions.' . $i . '.vn', ['required', 'label' => false, 'rows' => 3, 'value' => 'Bạn biết rõ mọi Nhân viên phải duy trì hoặc tuân thủ bảo mật của Công ty? Các nhân viên không được tiết lộ thông tin bảo mật liên quan đến công ty hoạt động và nhân viên Công ty, trừ khi được ủy quyền hoặc do yêu cầu công việc.', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                    <?= $this->Form->control('abc_questions.' . $i . '.en', ['required', 'label' => false, 'rows' => 3, 'value' => 'Have you understood that all Employees shall maintain and observe the strictest confidentially in respect of the Company? Employees shall not, except as authorised or required by their duties, reveal to any person any confidential information relating to the Company, its operations and its employees.', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                </div>
                            </div>
                            <?php $i++; ?>
                        </div>
                        <br />
                        <br />
                    </div>

                </div>
            </div>

            <?php $cat++; ?>
        </div>

        <div class="card">

            <div class="card-header">

                <h3 class="card-title"><?= $abcCategories[$cat - 1]->en ?></h3>
            </div>
            <div class="card-body">
                <div>

                    <div id="item_list_<?= $cat ?>">

                        <div class="row" id="item-<?= $i ?>-">
                            <?= $this->Form->hidden('abc_questions.' . $i . '.abc_category_id', ['value' => $cat]) ?>
                            <div class="col-md-2">
                                <div class="row">
                                    <?= $this->Form->control('abc_questions.' . $i . '.order_code', ['required','label' => false, 'value' => '9.1', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="form-label">Abnormal Answer</div>
                                        <?= $this->Form->radio('abc_questions.' . $i . '.abnormal', [['value' => 0, 'text' => 'No', 'checked'], ['value' => true, 'text' => 'Yes']], ['required', 'class' => 'custom-control-input', 'templateVars' => ['ctnClass' => 'custom-control custom-radio-md']]) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <?= $this->Form->control('abc_questions.' . $i . '.vn', ['required', 'label' => false, 'rows' => 3, 'value' => 'Trong năm qua, bạn đã hoàn toàn tuân thủ Chính sách Đạo đức Kinh doanh của Công ty?', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                    <?= $this->Form->control('abc_questions.' . $i . '.en', ['required', 'label' => false, 'rows' => 3, 'value' => 'During the past year, have you complied with the Business Ethics Policy, without exception?', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                </div>
                            </div>
                            <?php $i++; ?>
                        </div>
                        <br />
                        <br />


                        <div class="row" id="item-<?= $i ?>-">
                            <?= $this->Form->hidden('abc_questions.' . $i . '.abc_category_id', ['value' => $cat]) ?>
                            <div class="col-md-2">
                                <div class="row">
                                    <?= $this->Form->control('abc_questions.' . $i . '.order_code', ['required', 'label' => false, 'value' => '9.2', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="form-label">Abnormal Answer</div>

                                        <?= $this->Form->radio('abc_questions.' . $i . '.abnormal', [['value' => 0, 'text' => 'No'], ['value' => 1, 'text' => 'Yes', 'checked']], ['required', 'class' => 'custom-control-input', 'templateVars' => ['ctnClass' => 'custom-control custom-radio-md']]) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <?= $this->Form->control('abc_questions.' . $i . '.vn', ['required', 'label' => false, 'rows' => 3, 'value' => 'Bạn đã từng thực hiện công viêc nào cho hoặc thay mặt SOCO Vietnam mà không tuân thủ Quy tắc Đạo đức và Kinh doanh của SOCO?', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                    <?= $this->Form->control('abc_questions.' . $i . '.en', ['required', 'label' => false, 'rows' => 3, 'value' => 'Have you performed any services for or on behalf of SOCO Vietnam that were not conducted in compliance with SOCO’s Code of Business Conduct and Ethics?', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                </div>
                            </div>
                            <?php $i++; ?>
                        </div>
                        <br />
                        <br />


                    </div>

                </div>
            </div>

            <?php $cat++; ?>
        </div>

-->

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="form-footer mt-2 text-center">
                        <?= $this->Form->button(__('Create'), ['templateVars' => ['extra_class' => 'btn-primary']]) ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?= $this->Form->end() ?>