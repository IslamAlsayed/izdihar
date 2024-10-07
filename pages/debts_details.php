<?php $user_debts = selectRows('*', 'debts', "duration!=0 AND user_id=$user_id", '', '*'); ?>

<div class="customAlert"></div>
<section class="services-debts-details">

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
                        <div class=" col"><?= $debt['debt_goal'] ?></div>
                        <div class="col expenses_<?= $debt['id'] ?>"><?= $debt['expenses'] ?> ر.س</div>
                        <div class="col"><?= $debt['monthly_payment'] ?> ر.س</div>
                        <div class="col"><i class="fas fa-chevron-down"></i></div>
                    </div>

                    <div class="plan_payment">
                        <ul>
                            <h2>خطة الدفع</h2>
                            <?php $installment_count = ceil($debt['expenses'] / $debt['monthly_payment']);
                            $current_installments = $debt['duration'] - $installment_count; ?>
                            <?php for ($i = 1; $i <= $debt['duration']; $i++) {
                                if ($i == $debt['duration'] - 1) {
                                } ?>
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
                    </div>
                </div>
            <?php }
        } else { ?>
            <div class="tbody">
                <div class="center">لا يوجد ديون حتى الان!</div>
            </div>
        <?php }  ?>
    </div>
</section>