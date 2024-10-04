<div class="budget_preparation">

    <div class="head">
        <h2 class="headSection">إعداد الميزانية</h2>

        <p>
            <b class="site_name">إزدهار</b> يركز على تمكينك من إدارة أموالك بشكل فعال. نحن نقدم أدوات واستراتيجيات تساعدك على وضع ميزانية شاملة تتناسب مع احتياجاتك وأهدافك المالية. من خلال تحليل نفقاتك الشهرية وتحديد أولوياتك، نساعدك على تحقيق توازن
            مالي يتيح لك ادخار
            المزيد وتحقيق أهدافك. انضم إلينا لتطوير مهاراتك في إعداد الميزانية وابدأ في بناء مستقبل مالي أكثر استقرارًا ونجاحًا.
        </p>
    </div>
    <div class="content">
        <div class="image">
            <img src="<?= $image ?>calc.jpeg" alt="">
        </div>

        <div class="form">
            <label class="error_validation"></label>
            <form id="insert_budget_form">
                <div class="groups">
                    <div class="group">
                        <input type="text" name="monthly_amount" id="monthly_amount" placeholder=" " value="<?= $user_retirement_plan['monthly_amount'] ?>">
                        <label for="monthly_amount">الدخل الشهري</label>
                    </div>
                </div>

                <div class="groups">
                    <div class="group">
                        <input type="text" name="expenses" id="expenses" placeholder=" " value="<?= $user_retirement_plan['expenses'] ?>">
                        <label for="expenses">المصروفات</label>
                    </div>
                </div>

                <div class="groups">
                    <div class="group">
                        <input type="text" name="goal_amount" id="goal_amount" placeholder=" " value="<?= $user_retirement_plan['goal_amount'] ?>">
                        <label for="goal_amount">مبلغ الهدف</label>
                    </div>
                </div>
                <div class="groups">
                    <div class="group">
                        <input type="number" name="duration" id="duration" placeholder=" " disabled min="1">
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