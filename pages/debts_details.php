<?php $user_debts = selectRows('*', 'debts', "duration!=0 AND user_id=$user_id", '', '*'); ?>

<section class="services-debts-details">
    <label class="error_validation"></label>
    <div class="head">
        <h2>اعداد الديون</h2>

        <a href="./services.php?page=debts" class="btn btn-dark sup-link">
            إضافة ديون
        </a>
    </div>

    <div class="rows">
        <div class="thead">
            <div class="col"></div>
            <div class="col">نوع الديــــن</div>
            <div class="col">مبلغ الديـــن</div>
            <div class="col">القسط الشهري</div>
            <div class="col"></div>
        </div>

        <?php
        if (count($user_debts) > 0) {
            foreach ($user_debts as $key => $debt) { ?>
                <div class="tbody" id="debt_<?= $debt['id'] ?>">
                    <div class="row">
                        <div class="col"><i class="fas fa-minus" data-debt_id="<?= $debt['id'] ?>"></i></div>
                        <div class="col"><?= $debt['debt_goal'] ?></div>
                        <div class="col expenses_<?= $debt['id'] ?>"><?= $debt['expenses'] ?> ر.س</div>
                        <div class="col"><?= $debt['monthly_payment'] ?> ر.س</div>
                        <div class="col"><i class="fas fa-chevron-down"></i></div>
                    </div>

                    <div class="plan_payment">
                        <h2>خطة الدفع</h2>
                        <?php
                        $installment_count = ceil($debt['expenses'] / $debt['monthly_payment']);
                        $current_installments = $debt['duration'] - $installment_count;

                        $items_per_page = 12; // العدد الي معروض في الموقع
                        $total_pages = ceil($debt['duration'] / $items_per_page);
                        $current_page = isset($_GET['key']) ? (int)$_GET['key'] : 1;
                        $current_page = max(1, min($current_page, $total_pages));
                        $start_index = ($current_page - 1) * $items_per_page;
                        ?>

                        <ul>
                            <?php for ($i = 1; $i <= $debt['duration']; $i++) {
                                if ($i < $start_index + 1 || $i > $start_index + $items_per_page) {
                                    continue; // تخطي العناصر التي لا تنتمي لهذه الصفحة
                                }
                            ?>
                                <li class="<?= $i <= $current_installments ? 'disabled' : '' ?>">
                                    <span>
                                        <?php
                                        if ($i == $debt['duration']) {
                                            $remaining_amount = $debt['expenses'] % $debt['monthly_payment'];
                                            echo $remaining_amount > 0 ? $remaining_amount : $debt['monthly_payment'];
                                        } else {
                                            echo $debt['monthly_payment'];
                                        }
                                        ?> ر.س</span>
                                    <span>الشهر <?= $i ?>
                                        <i class="fas <?= $i > $current_installments ? 'fa-circle update_debt' : 'fa-check' ?>" data-order="<?= $i ?>" data-count="<?= $debt['duration'] ?>" data-debt_id="<?= $debt['id'] ?>"></i>
                                    </span>
                                </li>
                            <?php } ?>
                        </ul>

                        <?php if ($debt['duration'] > 12) { ?>
                            <div class="pagination">
                                <?php for ($p = 1; $p <= $total_pages; $p++): ?>
                                    <a href="./services.php?page=debts_details&key=<?= $p ?>" class="<?= $p == $current_page ? 'active' : '' ?>"><?= $p ?></a>
                                <?php endfor; ?>
                            </div>
                        <?php } ?>
                    </div>
                <?php }
        } else { ?>
                <div class="tbody">
                    <div class="center">لا يوجد ديون حتى الان!</div>
                </div>
            <?php }  ?>
                </div>
</section>

<script src="<?= $js . 'debt.js' ?>"></script>