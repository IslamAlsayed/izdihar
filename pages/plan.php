<section class="services-add-budget">
    <div class="head">
        <h2>خطة التقاعد</h2>

        <a href="./services.php?page=plan_chart" class="btn btn-dark sup-link">
            اعداد خطة التقاعد
        </a>
    </div>

    <div class="row">
        <form class="form">
            <div class="groups">
                <div class="group">
                    <label for="retirement_age">عمر التقاعد المناسب</label>
                    <input type="text" name="retirement_age" id="retirement_age">
                </div>
                <div class="group">
                    <label for="user_age">عمرك الان</label>
                    <input type="text" name="user_age" id="user_age" placeholder="عقار .. طبي .. قرض دراسي .. دين قرض شخصي">
                </div>
            </div>
            <div class="groups">
                <div class="group">
                    <label for="debts_and_expenses">الديون والمصروفات</label>
                    <input type="text" name="debts_and_expenses" id="debts_and_expenses">
                </div>
                <div class="group">
                    <label for="monthly_payment">المبلغ الشهري</label>
                    <input type="text" name="monthly_payment" id="monthly_payment">
                </div>
            </div>
            <div class="group">
                <label for="retirement_goal">الهدف المراد الوصول اليه عند التقاعد</label>
                <input type="text" name="retirement_goal" id="retirement_goal">
            </div>
            <button class="btn btn-dark" id="save">حفظ</button>
        </form>

        <div class="image">
            <img src="<?= $image ?>Revenue-bro.png" alt="">
        </div>
    </div>
</section>