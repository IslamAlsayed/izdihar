<?php $message = getFlashMessage();
$user_budgets = selectRows('*', 'budget', "user_id=$user_id", '', '*');
$user_debts = selectRows('*', 'debt', "user_id=$user_id", '', '*');

$monthlyIncome = 80000;
$expenses = 0;
$netIncome = 0;
$totalDuration = 0;
$cumulativeAmounts = [];

$lineChartData = [];
$categories = [];
$expensesData = [];
$durationMonths = [];

// حساب الميزانيات
foreach ($user_budgets as $budget) {
    $monthlyIncome += $budget['monthly_income'];
    $expenses += $budget['expenses'];
    $netIncome = $monthlyIncome - $expenses;

    $durationMonths = intval($budget['duration']);
    $totalDuration += $durationMonths;

    for ($month = 0; $month < $durationMonths; $month++) {
        $categories[$month] = date('M', strtotime("+$month month", strtotime(date('Y-m-01'))));
        $lineChartData[$month] = isset($lineChartData[$month]) ? $lineChartData[$month] + $netIncome : $netIncome;
    }
}

$debtsData = [];
$debtLabels = [];
$debtMap = [];

foreach ($user_debts as $debt) {
    $type = $debt['debt_type'];
    $amount = floatval($debt['debt_amount']);

    if (isset($debtMap[$type])) {
        $debtMap[$type] += $amount;
    } else {
        $debtMap[$type] = $amount;
    }
}

foreach ($debtMap as $type => $amount) {
    $debtLabels[] = $type;
    $debtsData[] = $amount;
}

$debtsData[] = $monthlyIncome;
$debtLabels[] = 'الدخل الشهري';
?>

<section class="services-content">
    <?php if (!empty($message['message'])) { ?>
        <div class="customAlert absolute <?= $message['status'] ?>"><?= $message['message'] ?></div>
    <?php } ?>

    <div class="head">
        <h2 class="headSection">إعداد الميزانية</h2>
        <a href="./services.php?page=add_budget" class="btn btn-dark add">
            <span>إضافة ميزانية</span>
            <i class="fas fa-add"></i>
        </a>
    </div>
    <div class="budget_cards">
        <div class="card">
            <h3>الدخل الشهري</h3>
            <span><?= $monthlyIncome > 0 ? $monthlyIncome . ' ' . $_SESSION['currency'] : '00' ?></span>
        </div>

        <div class="card">
            <h3>إجمالي المصروفات</h3>
            <span><?= $expenses > 0 ? $expenses . ' ' . $_SESSION['currency'] : '00' ?></span>
        </div>

        <div class="card">
            <h3>المبلغ المستهدف</h3>
            <span><?= isset($budget['target_amount']) ? $budget['target_amount'] . ' ' . $_SESSION['currency'] : '00' ?></span>
        </div>

        <div class="card">
            <h3>مدة الهدف</h3>
            <span><?= $totalDuration > 0 ? $totalDuration . ' month' : '0 month' ?></span>
        </div>

        <div class="card">
            <h3>نوع الهدف</h3>
            <span><?= isset($budget['target_type']) ? $budget['target_type'] : 'الهدف لم يتم تحديده بعد' ?></span>
        </div>
    </div>

    <?php if ($netIncome > 0) { ?>
        <div class="parentProgressChart">
            <div class="myChart myChart_1">
                <div id="myChartLine"></div>
            </div>
            <div class="myChart myChart_2">
                <div id="debtsChart"></div>
            </div>
        </div>
    <?php } ?>
</section>

<script>
    const lineChartData = <?= json_encode($lineChartData); ?>;
    const categories = <?= json_encode($categories); ?>;

    const optionsLine = {
        chart: {
            type: 'line',
            height: 350
        },
        series: [{
            name: 'Net Income',
            data: lineChartData
        }],
        xaxis: {
            categories: categories,
        },
        title: {
            text: 'Monthly Net Income',
            align: 'center'
        },
        colors: ['#5d64ae']
    };

    const chartLine = new ApexCharts(document.querySelector("#myChartLine"), optionsLine);
    chartLine.render();

    const debtsData = <?= json_encode($debtsData); ?>;
    const debtLabels = <?= json_encode($debtLabels); ?>;

    const debtsOptions = {
        chart: {
            type: 'donut',
            height: 350,
        },
        series: debtsData,
        labels: debtLabels,
        title: {
            text: 'توزيع المديونيات',
            align: 'center'
        },
        colors: ['#404f92', '#2f367d', '#4f5cbf', '#3e47a6'],
    };

    const debtsChart = new ApexCharts(document.querySelector("#debtsChart"), debtsOptions);
    debtsChart.render();
</script>