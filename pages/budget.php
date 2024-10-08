<?php
$user_budget = selectRows('*', 'budgets', "user_id=$user_id", '', '1');
$action = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['edit_budget'])) {
        $action = 'update';
    }
} elseif (!empty($user_budget)) {
    header('Location: ./services.php?page=budget_chart');
    exit();
}

$array_expenses = !empty($user_budget['expenses']) ? json_decode($user_budget['expenses'], true) : false;
?>

<section class="services-add-budget">
    <div class="head">
        <h2>اعداد الميزانية</h2>
    </div>

    <div class="row">
        <form id="budget_form" class="form" data-action="<?= empty($action) ? 'insert' : 'update' ?>">
            <label class="error_validation"></label>
            <div class="version">
                <div class="group">
                    <label for="monthly_income1">الدخل الشهري</label>
                    <input type="text" name="monthly_income1" id="monthly_income1" value="<?= $action == "update" ? $user_budget['monthly_income'] : ''  ?>">
                </div>

                <label for="expenses">المصروفات</label>
                <div class="groups">
                    <div class="group">
                        <input type="text" name="expenses[]" data-key="bills" value="<?= $action == '' ? '' : $array_expenses['bills'] ?? '' ?>" placeholder="فواتير">
                    </div>
                    <div class="group">
                        <input type="text" name="expenses[]" data-key="rent" value="<?= $action == '' ? '' : $array_expenses['rent'] ?? '' ?>" placeholder="ايجار">
                    </div>
                    <div class="group">
                        <input type="text" name="expenses[]" data-key="food" value="<?= $action == '' ? '' : $array_expenses['food'] ?? '' ?>" placeholder="طعام">
                    </div>
                    <div class="group">
                        <input type="text" name="expenses[]" data-key="healthcare" value="<?= $action == '' ? '' : $array_expenses['healthcare'] ?? '' ?>" placeholder="رعاية صحية">
                    </div>
                    <div class="group">
                        <input type="text" name="expenses[]" data-key="clothing" value="<?= $action == '' ? '' : $array_expenses['clothing'] ?? '' ?>" placeholder="ملابس">
                    </div>
                    <div class="group">
                        <input type="text" name="expenses[]" data-key="entertainment" value="<?= $action == '' ? '' : $array_expenses['entertainment'] ?? '' ?>" placeholder="ترفية">
                    </div>
                </div>

                <div class="col">
                    <button type="type" class="btn btn-dark" id="more_details"><?= empty($user_budget) ? 'حفظ' : 'تحديث' ?></button>
                </div>
            </div>

            <div class="version more_details">
                <div class="group">
                    <label for="monthly_income2">الدخل الشهري</label>
                    <input type="text" name="monthly_income2" id="monthly_income2" value="<?= $action == "update" ? $user_budget['monthly_income'] : ''  ?>">
                </div>
                <div class="groups">
                    <div class="group">
                        <label for="budget_goal">الهدف</label>
                        <input type="text" name="budget_goal" id="budget_goal" value="<?= $action == 'update' ? $user_budget['budget_goal'] : '' ?>">
                    </div>
                    <div class="group">
                        <label for="expenses">اجمالي المصروفات</label>
                        <input type="text" name="expenses" id="expenses" value="<?= $action == 'update' ? $user_budget['expenses'] : '' ?>" disabled>
                    </div>
                    <div class="group">
                        <label for="goal_date">تاريخ انجاز الهدف بالشهر</label>
                        <input type="text" name="goal_date" id="goal_date" value="<?= $action == 'update' ? $user_budget['goal_date'] : '' ?>" disabled>
                    </div>
                    <div class="group">
                        <label for="selling_goal">مبلغ الهدف</label>
                        <input type="text" name="selling_goal" id="selling_goal" value="<?= $action == 'update' ? $user_budget['selling_goal'] : '' ?>">
                    </div>
                </div>

                <div class="col">
                    <button class="btn btn-dark" id="insert_budget"><?= empty($user_budget) ? 'حفظ' : 'تحديث' ?></button>
                </div>
            </div>
        </form>

        <div class="image">
            <img src="<?= $image ?>Investment data-amico.png" alt="">
        </div>
    </div>
</section>

<script src="<?= $js . 'budget.js' ?>"></script>