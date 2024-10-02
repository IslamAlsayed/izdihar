<section class="services-content">
    <h2 class="headSection">خطة التقاعد</h2>

    <div class="content">
        <div class="image">
            <img src="<?= $image  . 'do.jpeg' ?>" alt="">
        </div>

        <div class="form">
            <label class="error_validation"></label>
            <form id="insert_plan_form">
                <div class="group">
                    <input type="text" name="retirement_age" id="retirement_age" value="60" placeholder=" ">
                    <label for="retirement_age">السن المناسب للتقاعد</label>
                </div>
                <div class="group">
                    <input type="text" name="user_old" id="user_old" placeholder=" ">
                    <label for="user_old">كم عمرك الآن؟</label>
                </div>
                <div class="group">
                    <input type="text" name="monthly_amount" id="monthly_amount" placeholder=" ">
                    <label for="monthly_amount">المبلغ الشهري</label>
                </div>
                <div class="group">
                    <input type="text" name="debts_and_expenses" id="debts_and_expenses" placeholder=" ">
                    <label for="debts_and_expenses">الديون والنفقات</label>
                </div>
                <div class="group">
                    <input type="text" name="goal_retirement" id="goal_retirement" placeholder=" ">
                    <label for="goal_retirement">الهدف الذي تريد تحقيقه عند التقاعد</label>
                </div>

                <div class="group">
                    <button type="submit" name="insert_plan" id="insert_plan" class="btn btn-dark">إرسال خطة التقاعد</button>
                </div>
            </form>
        </div>
    </div>
</section>