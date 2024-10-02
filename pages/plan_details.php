<?php
$user_plan = selectRows('*', 'retirement_plan', "user_id=$user_id", '', '1');

$current_salary = $user_plan['current_salary'];
$retirement_age = $user_plan['retirement_age'];
$monthly_amount = $user_plan['monthly_amount'];
$debts_and_expenses = $user_plan['debts_and_expenses'];
$goal_retirement = $user_plan['goal_retirement'];
$user_old = $user_plan['user_old'];

// حساب المدخرات الشهرية
$amount_left_to_save_per_month = $current_salary - $debts_and_expenses;

// حساب عدد السنوات حتى التقاعد
$years_until_retirement = $retirement_age - $user_old;

// حساب المدخرات الكلية
$total_savings = $amount_left_to_save_per_month * 12 * $years_until_retirement;
?>

<section class="calculate">
    <h2 class="headSection">تفاصل خطة التقاعد</h2>

    <div class="rows">
        <div class="row">
            <div class="col">سن االتقاعد:</div>
            <div class="col"><?= $user_plan['retirement_age'] ?> سنة</div>
        </div>
        <div class="row">
            <div class="col">عمرك الآن:</div>
            <div class="col"><?= $user_plan['user_old'] ?> سنة</div>
        </div>
        <div class="row">
            <div class="col">راتبط الشهري:</div>
            <div class="col"><?= $user_plan['monthly_amount'] . ' ' . $_SESSION['currency'] ?></div>
        </div>
        <div class="row">
            <div class="col">ديونك ونفقاتك في الشهر:</div>
            <div class="col"><?= $user_plan['debts_and_expenses'] .  ' ' . $_SESSION['currency'] ?></div>
        </div>
        <div class="row">
            <div class="col">هدفك الذي تريد تحقيقه عند التقاعد:</div>
            <div class="col"><?= $user_plan['goal_retirement'] .  ' ' . $_SESSION['currency'] ?></div>
        </div>
    </div>

    <div class="total">
        <h3>
            <?= $total_savings >= $goal_retirement ?
                'مبروك! سوف تكون قادرًا على الوصول إلى هدف التقاعد' :
                'للأسف، لن تتمكن من الوصول إلى هدف التقاعد بناءً على الادخار الحالي' ?>
        </h3>
    </div>
</section>