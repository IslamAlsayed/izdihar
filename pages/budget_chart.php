<?php
$user_budgets = selectRows('*', 'budgets', "user_id=$user_id", '', '1');
$user_debts = selectRows('*', 'debts', "user_id=$user_id", '', '*');

if (empty($user_budget)) {
    header('Location: ./services.php?page=budget');
    exit();
}

// صافي الدخل
$net_income = $user_budget['net_income'];

// مبلغ الادخار الشهري
$installment_monthly = $user_budget['selling_goal'] / $user_budget['goal_date'];

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

// إعداد الشهور والبيانات للمخطط
$months = [];
$net_income_data = [];
$total_expenses_data = [];

// فقط الأشهر التي تحتوي على نفقات
foreach ($monthly_expenses as $month => $total_expense) {
    $months[] = $month;
    $net_income = $installment_monthly - $total_expense; // صافي المال بعد النفقات
    $net_income_data[] = $net_income;
    $total_expenses_data[] = $total_expense; // بيانات المصروفات
}
?>

<?php
$expenses = json_decode($user_budgets['expenses'], true);

// إعداد البيانات للمخطط الدائري
$expense_types = [];

// جمع المصروفات
foreach ($expenses as $type => $amount) {
    if ($amount != 0) {
        $expense_types[$type] = floatval($amount);
    }
}

// حساب المجموع الكلي للمصروفات
$total_expenses = array_sum($expense_types);

// حساب النسب المئوية
$expense_percentages = [];
foreach ($expense_types as $type => $amount) {
    $expense_percentages[$type] = ($amount / $total_expenses) * 100; // النسبة المئوية
}

// تحويل البيانات إلى JSON
$expense_labels = array_keys($expense_percentages);
$expense_data = array_values($expense_percentages);

$expense_data_json = json_encode($expense_data);
$expense_labels_json = json_encode($expense_labels);

?>


<section class="services-budget-chart">
    <h2>تحـــديد الهــدف</h2>

    <div class="cards">
        <div class="card">
            <h2>الدخل الشهري</h2>
            <h3><?= number_format($user_budget['monthly_income']) . 'ر.س' ?></h3>
        </div>
        <div class="card">
            <h2>اجمالي المصروفات</h2>
            <h3><?= number_format($user_budget['total_expenses']) . 'ر.س'  ?></h3>
        </div>
        <div class="card">
            <h2>مبلغ الهدف</h2>
            <h3><?= number_format($user_budget['selling_goal']) . 'ر.س'  ?></h3>
        </div>
        <div class="card">
            <h2>مدة الهدف</h2>
            <h3><?= $user_budget['goal_date'] . 'شهر' ?></h3>
        </div>
    </div>
    <div class="charts">
        <div id="my_chart_line"></div>
        <div id="my_chart_donut"></div>
    </div>
</section>

<!-- الميزانية -->
<script>
    var options = {
        series: [{
                name: 'صافي المال',
                data: <?= json_encode($net_income_data); ?>
            },
            {
                name: 'الادخار المستهدف شهريًا',
                data: Array(<?= count($months); ?>).fill(<?= $installment_monthly; ?>) // خط ثابت للقسط الشهري
            },
            {
                name: 'المصروفات الشهرية',
                data: <?= json_encode($total_expenses_data); ?> // بيانات المصروفات
            }
        ],
        chart: {
            type: 'line',
            height: 350
        },
        colors: ['#435760', '#81A9B9', '#FF5733'], // إضافة لون للمصروفات
        title: {
            text: "النفقات الشهرية مقابل الادخار المستهدف",
            align: 'left',
        },
        xaxis: {
            categories: <?= json_encode($months); ?>,
            title: {
                text: 'الشهر',
                align: 'left',
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

<!-- إعداد مخطط الديون -->
<script>
    var debtData = <?= $expense_data_json ?>;
    var debtLabels = <?= $expense_labels_json ?>;

    var debtOptions = {
        chart: {
            type: 'donut',
            height: 350
        },
        series: debtData,
        labels: debtLabels,
        title: {
            text: 'توزيع المصروفات',
            align: 'center'
        },
        colors: ['#4e5389', '#3b428e', '#5D64AE', '#4c54a6'],
    };

    var my_chart_donut = new ApexCharts(document.querySelector("#my_chart_donut"), debtOptions);
    my_chart_donut.render();
</script>