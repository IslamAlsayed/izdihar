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
$installment_monthly = $user_retirement_plan['retirement_goal'] / ($user_retirement_age * 12);
?>

<section class="services-plan-chart">
    <label class="error_validation"></label>
    <h2>خطة التقاعد</h2>

    <div class="actions">
        <form action="./services.php?page=plan" method="POST" id="edit_plan_form">
            <button type="submit" class="btn btn-dark active" name="edit_plan" id="edit_plan">تعديل</button>
        </form>
        <button class="btn btn-dark active" id="delete_plan" data-id="<?= $user_retirement_plan['id'] ?? '' ?>">حذف</button>
    </div>

    <div class=" content">
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
                <h2>مبلغ الادخار في الشهر</h2>
                <h3><?= number_format($installment_monthly, 3) . 'ر.س'  ?? '00' ?> </h3>
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
    // بيانات المستخدم
    const debtsAndExpenses = <?= $user_retirement_plan['debts_and_expenses'] ?>; // الديون والمصاريف
    const retirementGoal = <?= $user_retirement_plan['retirement_goal'] ?>; // الهدف المراد الوصول إليه
    const userAge = <?= $user_retirement_plan['user_age'] ?>; // عمر المستخدم
    const retirementAge = <?= $user_retirement_plan['retirement_age'] ?>; // عمر التقاعد

    // مدة الهدف
    const userRetirementAge = retirementAge - userAge;

    // مبلغ الادخار الشهري
    const installmentMonthly = retirementGoal / (userRetirementAge * 12);

    // البيانات الأساسية للرسم البياني
    const months = [];
    const savings = [];
    const targetAmount = retirementGoal; // الهدف المراد الوصول إليه
    let currentSavings = 0; // بدء مبلغ الادخار الحالي من صفر

    // حساب المدخرات على مدى مدة الهدف (بالسنوات) ولكن عرض كل 12 شهر
    for (let i = 0; i <= userRetirementAge * 12; i += 12) {
        months.push(i / 12); // تحويل إلى سنوات
        currentSavings += installmentMonthly * 12; // إضافة المدخرات لكل 12 شهر
        savings.push(currentSavings); // القيمة الحالية
    }

    const targetSavings = new Array(months.length).fill(targetAmount);

    const options = {
        chart: {
            type: 'line',
            height: 350
        },
        series: [{
            name: 'المدخرات السنوية',
            data: savings
        }],
        xaxis: {
            categories: months,
            title: {
                text: 'السنوات'
            }
        },
        yaxis: {
            title: {
                text: 'القيمة (ر.س) في السنة'
            },
            labels: {
                formatter: function(value) {
                    return value.toFixed(0);
                }
            }
        },
        markers: {
            size: 5,
        },
        tooltip: {
            shared: true,
            intersect: false
        },
        colors: ['#435760'],
    };

    const my_chart_line = new ApexCharts(document.querySelector("#my_chart_line"), options);
    my_chart_line.render();
</script>

<script src="<?= $js . 'retirement_plan.js' ?>"></script>