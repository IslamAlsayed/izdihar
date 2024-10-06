<?php
$user_retirement_plan = selectRows('*', 'retirement_plan', "user_id=$user_id", '', '1');
$user_budgets = selectRows('*', 'budgets', "user_id=$user_id", '', '1');
$user_debts = selectRows('*', 'debts', "user_id=$user_id", '', '*');

if (!isset($user_retirement_plan) || empty($user_retirement_plan)) {
    header('Location: ./services.php?page=plan');
    exit();
}

// صافي الدخل
$net_income = $user_retirement_plan['monthly_income'] - $user_retirement_plan['debts_and_expenses'];

// مدة الهدف
$user_retirement_age = $user_retirement_plan['retirement_age'] - $user_retirement_plan['user_age'];

// مبلغ الادخار الشهري
$installment_monthly = $user_retirement_plan['retirement_goal'] / $net_income;

// جميع النفقات الشهرية
$monthly_expenses = [];

// إضافة النفقات من الديون
foreach ($user_debts as $debt) {
    $month = date('Y-m', strtotime($debt['created_at']));
    if (!isset($monthly_expenses[$month])) {
        $monthly_expenses[$month] = 0;
    }
    $monthly_expenses[$month] += intval($debt['expenses']);
}

// إضافة مصروفات الميزانية
if ($user_budgets) {
    $month = date('Y-m', strtotime($user_budgets['created_at']));
    $expenses = json_decode($user_budgets['expenses'], true);
    if (is_array($expenses)) {
        $total_expenses = array_sum($expenses);

        if (!isset($monthly_expenses[$month])) {
            $monthly_expenses[$month] = 0;
        }
        $monthly_expenses[$month] += $total_expenses;
    }
}

// إعداد الشهور وصافي المال
$months = [];
$net_income_data = [];

// فقط الأشهر التي تحتوي على نفقات
foreach ($monthly_expenses as $month => $total_expense) {
    $months[] = $month;
    $net_income_data[] = $installment_monthly - $total_expense; // صافي المال بعد النفقات
}
?>

<section class="services-plan-chart">
    <h2>خطة التقاعد</h2>

    <div class="content">
        <div class="cards">
            <div class="card">
                <h2>الدخل الشهري</h2>
                <h3><?= number_format($user_retirement_plan['monthly_income']) . 'ر.س'  ?? '00' ?> </h3>
            </div>
            <div class="card">
                <h2>اجمالي المصروفات</h2>
                <h3><?= number_format($user_retirement_plan['debts_and_expenses']) . 'ر.س'  ?? '00' ?> </h3>
            </div>
            <div class="card">
                <h2>مدة الهدف</h2>
                <h3><?= $user_retirement_age > 1 ? $user_retirement_age . 'عام' : $user_retirement_age * 12 . 'شهر'  ?? '0' ?> </h3>
            </div>
            <div class="card">
                <h2>عمر التقاعد</h2>
                <h3><?= $user_retirement_plan['retirement_age'] . 'عام'  ?? '0 عام' ?> </h3>
            </div>
            <div class="card">
                <h2>مبلغ الادخار</h2>
                <h3><?= number_format($installment_monthly) . 'ر.س'  ?? '00' ?> </h3>
            </div>
            <div class="card">
                <h2>الهدف المراد الوصول اليه</h2>
                <h3><?= number_format($user_retirement_plan['retirement_goal']) . 'ر.س'  ?? '00' ?> </h3>
            </div>
        </div>

        <div class="chart">
            <div id="my_chart_line"></div>
        </div>
    </div>
</section>

<script>
    var options = {
        series: [{
                name: 'صافي المال',
                data: <?= json_encode($net_income_data); ?>
            },
            {
                name: 'الادخار المستهدف شهريًا',
                data: Array(<?= count($months); ?>).fill(<?= $installment_monthly; ?>) // خط ثابت للقسط الشهري
            }
        ],
        chart: {
            type: 'line',
            height: 350
        },
        colors: ['#435760', '#81A9B9'],
        title: {
            text: "النفقات الشهرية مقابل الادخار المستهدف",
            align: 'center',
        },
        xaxis: {
            categories: <?= json_encode($months); ?>,
            title: {
                text: 'الشهر',
                align: 'center',
            }
        },
        yaxis: {
            title: {
                text: "الكمية"
            }
        },
    };

    var my_chart_line = new ApexCharts(document.querySelector("#my_chart_line"), options);
    my_chart_line.render();
</script>