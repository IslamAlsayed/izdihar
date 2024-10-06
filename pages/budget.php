<section class="services-add-budget">
    <div class="head">
        <h2>اعداد الميزانية</h2>

        <a href="./services.php?page=budget_chart" class="btn btn-dark sup-link">
            تحديد الهدف
        </a>
    </div>

    <label class="error_validation"></label>

    <div class="row">
        <form id="insert_budget_form" class="form">
            <div class="group">
                <label for="monthly_income1">الدخل الشهري</label>
                <input type="text" name="monthly_income1" id="monthly_income1">
            </div>

            <label for="expenses">المصروفات</label>
            <div class="groups">
                <div class="group">
                    <input type="text" name="expenses[]" data-key="bills" placeholder="فواتير">
                </div>
                <div class="group">
                    <input type="text" name="expenses[]" data-key="rent" placeholder="ايجار">
                </div>
                <div class="group">
                    <input type="text" name="expenses[]" data-key="food" placeholder="طعام">
                </div>
                <div class="group">
                    <input type="text" name="expenses[]" data-key="healthcare" placeholder="رعاية صحية">
                </div>
                <div class="group">
                    <input type="text" name="expenses[]" data-key="clothing" placeholder="ملابس">
                </div>
                <div class="group">
                    <input type="text" name="expenses[]" data-key="entertainment" placeholder="ترفية">
                </div>
            </div>

            <button class="btn btn-dark disabled" id="save" id="budget_type">حفظ</button>
        </form>

        <div class="image">
            <img src="<?= $image ?>Investment data-amico.png" alt="">
        </div>
    </div>

    <div class="row hide">
        <form class="form">
            <div class="group">
                <label for="monthly_income2">الدخل الشهري</label>
                <input type="text" name="monthly_income2" id="monthly_income2">
            </div>
            <div class="groups">
                <div class="group">
                    <label for="budget_goal">الهدف</label>
                    <input type="text" name="budget_goal" id="budget_goal">
                </div>
                <div class="group">
                    <label for="expenses">اجمالي المصروفات</label>
                    <input type="text" name="expenses" id="expenses">
                </div>
                <div class="group">
                    <label for="goal_date">تاريخ انجاز الهدف</label>
                    <input type="text" name="goal_date" id="goal_date">
                </div>
                <div class="group">
                    <label for="selling_goal">مبلغ الهدف</label>
                    <input type="text" name="selling_goal" id="selling_goal">
                </div>
            </div>

            <button type="submit" class="btn btn-dark disabled" id="insert_budget">حفظ</button>
        </form>

        <div class="image">
            <img src="<?= $image ?>Manage money-bro.png" alt="">
        </div>
    </div>

</section>