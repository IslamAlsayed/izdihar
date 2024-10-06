<?php $user_debts = selectRows('*', 'debts', "duration!=0 AND user_id=$user_id", '', '*');

if (count($user_debts) <= 0) {
    header('Location: ./services.php?page=debts');
    exit();
}
?>

<div class="customAlert"></div>
<section class="services-debts-details">
    <h2>اعداد الميزانية</h2>

    <div class="rows">
        <div class="thead">
            <div class="col"></div>
            <div class="col">نوع الديــــن</div>
            <div class="col">مبلغ الديـــن</div>
            <div class="col">القسط الشهري</div>
            <div class="col"></div>
        </div>
        <?php foreach ($user_debts as $key => $debt) { ?>
            <div class="tbody" id="debt_<?= $debt['id'] ?>">
                <div class=" row">
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
                        <?php for ($i = 1; $i <= $debt['duration']; $i++) { ?>
                            <li class="<?= $i <= $current_installments ? 'disabled' : '' ?>">
                                <span><?= $debt['monthly_payment'] ?> ر.س</span>
                                <span>الشهر <?= $i ?>

                                    <i class="fas <?= $i > $current_installments ? 'fa-circle update_debt' : 'fa-check' ?>" data-debt_id="<?= $debt['id'] ?>"></i>
                                </span>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        <?php } ?>
    </div>
</section>