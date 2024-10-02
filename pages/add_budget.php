<div class="budget_preparation">
    <h2 class="headSection">إعداد الميزانية</h2>

    <div class="content">
        <div class="image">
            <img src="<?= $image ?>calc.jpeg" alt="">
        </div>

        <div class="form">
            <label class="error_validation"></label>
            <form id="insert_budget_form">
                <div class="groups">
                    <div class="group">
                        <input type="text" name="monthly_income" id="monthly_income" placeholder=" ">
                        <label for="monthly_income">الدخل الشهري</label>
                    </div>
                </div>

                <div class="groups">
                    <div class="group">
                        <input type="text" name="expenses" id="expenses" placeholder=" ">
                        <label for="expenses">المصروفات</label>
                    </div>
                    <div class="group">
                        <input type="text" name="goal_type" id="goal_type" placeholder=" ">
                        <label for="goal_type">نوع الهدف</label>
                    </div>
                </div>

                <div class="groups">
                    <div class="group">
                        <input type="text" name="goal_amount" id="goal_amount" placeholder=" ">
                        <label for="goal_amount">مبلغ الهدف</label>
                    </div>
                    <div class="group">
                        <input type="text" name="duration" id="duration" placeholder=" ">
                        <label for="duration">المدة بالشهر</label>
                    </div>
                </div>

                <div class="submit">
                    <button type="submit" name="insert_budget" id="insert_budget" class="btn btn-dark">حفظ</button>
                </div>
            </form>
        </div>
    </div>
</div>