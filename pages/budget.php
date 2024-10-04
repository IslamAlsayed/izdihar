<?php
$message = getFlashMessage();
$currency = $_SESSION['currency'];

$user_retirement_plan = selectRows('*', 'retirement_plan', "user_id=$user_id", '', '1');
$user_debts = selectRows('*', 'debt', "user_id=$user_id", '', '*');

if (empty($user_retirement_plan)) {
    header('Location: ./services.php?page=plan');
    exit();
}

// حساب عدد السنوات حتى التقاعد
$years_until_retirement = intval($user_retirement_plan['retirement_age']) - intval($user_retirement_plan['user_old']);

// الهدف بعد التقاعد
$goal_retirement = $user_retirement_plan['goal_retirement'];

// القسط الشهري المطلوب
$monthly_target_savings = ceil($goal_retirement / ($years_until_retirement * 12));

// جميع النفقات الشهرية
$monthly_expenses = [];
foreach ($user_debts as $debt) {
    $month = date('Y-m', strtotime($debt['created_at']));
    if (!isset($monthly_expenses[$month])) {
        $monthly_expenses[$month] = 0;
    }
    $monthly_expenses[$month] += intval($debt['debt_amount']);
}

$expenses = 0;
foreach ($monthly_expenses as $expense) $expenses += $expense;

// إعداد البيانات للرسم البياني
$months = array_keys($monthly_expenses);
$expenses_data = array_values($monthly_expenses);
$target_savings_data = array_fill(0, count($months), $monthly_target_savings);


// إعداد بيانات الديون
$debt_types = [];
foreach ($user_debts as $debt) {
    // تحويل القيم النصية إلى أرقام صحيحة أو عشرية
    $debt_amount = floatval($debt['debt_amount']);
    if (isset($debt_types[$debt['debt_type']])) {
        $debt_types[$debt['debt_type']] += $debt_amount;
    } else {
        $debt_types[$debt['debt_type']] = $debt_amount;
    }
}

// حساب الدخل الشهري
$debt_types['الدخل الشهري'] = array_sum(array_map('floatval', array_column($user_debts, 'debt_monthly'))) * 12;

// تحويل البيانات إلى JSON
$debt_labels = array_keys($debt_types);
$debt_data = array_values($debt_types);

$debt_data_json = json_encode($debt_data);
$debt_labels_json = json_encode($debt_labels);
?>

<section class="services-content">
    <div class="head">
        <h2 class="headSection">إعداد الميزانية</h2>

        <p>يهدف قسم <b class="site_name">إعداد الميزانية</b> إلى مساعدتك في تتبع نفقاتك الشهرية ومقارنتها بالمدخرات المستهدفة لتحقيق هدفك المالي بعد التقاعد. من خلال تحليل نفقاتك، يمكنك تحديد الفرص لتقليل المصاريف وزيادة المدخرات لضمان مستقبل مالي
            آمن. استخدم أدواتنا
            البصرية لمراقبة تقدمك المالي وتعديل ميزانيتك بناءً على البيانات الفعلية.</p>

        <a href="./services.php?page=add_debt" class="btn btn-dark">
            <span>إضافة دييون</span>
            <i class="fas fa-add"></i>
        </a>
    </div>

    <div class="budget_cards">
        <div class="card">
            <h3>الدخل الشهري</h3>
            <span><?= number_format($user_retirement_plan['monthly_amount']) . ' ' . $currency ?? '00' ?></span>
        </div>

        <div class="card">
            <h3>إجمالي المصروفات</h3>
            <span><?= number_format($expenses) . ' ' . $currency ?? '00' ?></span>
        </div>

        <div class="card">
            <h3>المبلغ المستهدف</h3>
            <span><?= number_format($user_retirement_plan['goal_retirement']) . ' ' . $currency ?? '00' ?></span>
        </div>

        <div class="card">
            <h3>مدة الهدف</h3>
            <span><?= $years_until_retirement . ' عام' ?? '--' ?></span>
        </div>

        <div class="card">
            <h3>نوع الهدف</h3>
            <span><?= $user_retirement_plan['goal_type'] ?? '--' ?></span>
        </div>
    </div>

    <div class="parentProgressChart">
        <div class="myChart myChart_1">
            <div id="myChartLine"></div>
        </div>
        <div class="myChart myChart_2">
            <div id="debtsChart"></div>
        </div>
    </div>
</section>

<script>
    var options = {
        series: [{
                name: 'ديون ونفقات الشهر',
                data: <?php echo json_encode($expenses_data); ?>
            },
            {
                name: 'الادخار المستهدف شهريا',
                data: <?php echo json_encode($target_savings_data); ?>
            }
        ],
        chart: {
            type: 'line',
            height: 350
        },
        colors: ['#5D64AE', '#0619e2'],
        title: {
            text: "النفقات الشهرية مقابل الادخار المستهدف",
            align: 'center',
        },
        xaxis: {
            categories: <?php echo json_encode($months); ?>,
            title: {
                text: 'الشهر',
                align: 'center',
            }
        },
        yaxis: {
            title: {
                text: "الكمية <?= $currency ?>"
            }
        },
    };

    var myChartLine = new ApexCharts(document.querySelector("#myChartLine"), options);
    myChartLine.render();
</script>

<script>
    // إعداد مخطط الديون
    var debtData = <?= $debt_data_json ?>;
    var debtLabels = <?= $debt_labels_json ?>;

    var debtOptions = {
        chart: {
            type: 'donut',
            height: 350
        },
        series: debtData,
        labels: debtLabels,
        title: {
            text: 'توزيع الديون',
            align: 'center'
        },
        colors: ['#4e5389', '#3b428e', '#5D64AE', '#4c54a6'],
    };

    var debtChart = new ApexCharts(document.querySelector("#debtsChart"), debtOptions);
    debtChart.render();
</script>