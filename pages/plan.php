<?php
$user_retirement_plan = selectRows('*', 'retirement_plan', "user_id=$user_id", '', '1');
$action = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['edit_plan'])) {
        $action = 'update';
    }
} elseif (!empty($user_retirement_plan)) {
    header('Location: ./services.php?page=plan_chart');
    exit();
}
?>

<section class="services-add-budget">
    <div class="head">
        <h2>خطة التقاعد</h2>
    </div>

    <div class="row">
        <form id="retirement_plan_form" class="form" data-action="<?= empty($action) ? 'insert' : 'update' ?>">
            <div class="version">
                <label class="error_validation"></label>
                <div class="groups">
                    <div class="group">
                        <label for="retirement_age">عمر التقاعد المناسب</label>
                        <input type="text" name="retirement_age" id="retirement_age" value="<?= $action == 'update' ? $user_retirement_plan['retirement_age'] : '' ?>">
                    </div>
                    <div class="group">
                        <label for="user_age">عمرك الان</label>
                        <input type="text" name="user_age" id="user_age" value="<?= $action == 'update' ? $user_retirement_plan['user_age'] : '' ?>">
                    </div>
                </div>
                <div class="groups">
                    <div class="group">
                        <label for="debts_and_expenses">الديون والمصروفات</label>
                        <input type="text" name="debts_and_expenses" id="debts_and_expenses" value="<?= $action == 'update' ? $user_retirement_plan['debts_and_expenses'] : '' ?>">
                    </div>
                    <div class="group">
                        <label for="monthly_income">المبلغ الشهري</label>
                        <input type="text" name="monthly_income" id="monthly_income" value="<?= $action == 'update' ? $user_retirement_plan['monthly_income'] : '' ?>">
                    </div>
                </div>
                <div class="group">
                    <label for="retirement_goal">الهدف المراد الوصول اليه عند التقاعد</label>
                    <input type="text" name="retirement_goal" id="retirement_goal" value="<?= $action == 'update' ? $user_retirement_plan['retirement_goal'] : '' ?>">
                </div>
                <?php if (empty($user_retirement_plan)) { ?>
                    <button type="submit" class="btn btn-dark" id="insert_plan">حفظ</button>
                <?php } else { ?>
                    <button type="submit" class="btn btn-dark" id="update_plan">تحديث</button>
                <?php } ?>
            </div>
        </form>

        <div class="image">
            <img src="<?= $image ?>Revenue-bro.png" alt="">
        </div>
    </div>
</section>

<script src="<?= $js . 'retirement_plan.js' ?>"></script>