<?php

if (!isset($_SESSION['plan_details']) && $_SESSION['plan_details'] != 'yes') {
    header('Location: ./services.php?page=plan');
    exit();
}

$currency = $_SESSION['currency'];
$user_retirement_plan = selectRows('*', 'retirement_plan', "user_id=$user_id", '', '1');
$user_debts = selectRows('*', 'debts', "user_id=$user_id", '', '*');
$expenses = 0;
foreach ($user_debts as $debt) $expenses += $debt['debt_amount'];

// حساب المدخرات الشهرية
$amount_left_to_save_per_month = $user_retirement_plan['monthly_amount'] - $expenses;

// حساب عدد السنوات حتى التقاعد
$years_until_retirement = intval($user_retirement_plan['retirement_age']) - intval($user_retirement_plan['user_old']);

// الهدف بعد التقاعد
$goal_retirement = $user_retirement_plan['goal_retirement'];

// القسط الشهري المطلوب
$monthly_target_savings = ceil($goal_retirement / ($years_until_retirement * 12));
?>

<section class="calculate">
    <div class="head">
        <h2 class="headSection">تفاصيل خطة التقاعد</h2>

        <a href="./services.php?page=add_debt" class="btn btn-dark">
            <i class="fas fa-plus"></i>
            <span>إضافة نفقات</span>
        </a>
    </div>

    <div class="rows">
        <div class="row">
            <div class="col">سن االتقاعد:</div>
            <div class="col"><?= $user_retirement_plan['retirement_age'] ?> عام</div>
        </div>
        <div class="row">
            <div class="col">عمرك الآن:</div>
            <div class="col"><?= $user_retirement_plan['user_old'] ?> عام</div>
        </div>
        <div class="row">
            <div class="col">مدة الهدف:</div>
            <div class="col"><?= $years_until_retirement ?> عام</div>
        </div>
        <div class="row">
            <div class="col">الدخل الشهري:</div>
            <div class="col"><?= $user_retirement_plan['monthly_amount'] . ' ' . $currency ?></div>
        </div>
        <div class="row">
            <div class="col">جميع الديون والنفقات:</div>
            <div class="col"><?= number_format($expenses) .  ' ' . $currency ?></div>
        </div>
        <div class="row">
            <div class="col">صافي المال لتحقيق الهدف:</div>
            <div class="col"><?= number_format($monthly_target_savings) .  ' ' . $currency ?></div>
        </div>
        <div class="row">
            <div class="col">هدفك الذي تريد تحقيقه عند التقاعد:</div>
            <div class="col"><?= number_format($goal_retirement) .  ' ' . $currency ?></div>
        </div>
        <div class="row">
            <div class="col">
                <form action="./services.php?page=plan" method="POST">
                    <input type="hidden" name="update_plan" value="update_<?= $user['password'] ?>_plan">
                    <button type="submit" class="btn btn-dark edit_plan">تعديل خطة التقاعد</button>
                </form>
            </div>
        </div>
    </div>

    <div class="total">
        <h3>ألتزم بصافي المال في كل شهر للوصل الي الهدف عند التقاعد</h3>
    </div>
</section>