<section class="services-add-budget">
    <div class="head">
        <h2>إدارة الديون</h2>
    </div>

    <div class="row">
        <form id="debt_form" class="form">
            <div class="version">
                <label class="error_validation"></label>
                <div class="group">
                    <label for="debt_goal">نـــوع الدين</label>
                    <input type="text" name="debt_goal" id="debt_goal" placeholder="عقار .. طبي .. قرض دراسي .. دين قرض شخصي">
                </div>
                <div class="groups">
                    <div class="group">
                        <label for="monthly_payment">الدفعه الشهرية</label>
                        <input type="text" name="monthly_payment" id="monthly_payment">
                    </div>
                    <div class="group">
                        <label for="expenses">أجمالي مبلغ الدين</label>
                        <input type="text" name="expenses" id="expenses">
                    </div>
                </div>
                <div class="group">
                    <label for="duration">المدة المتبقية للسداد</label>
                    <input type="text" name="duration" id="duration" disabled>
                </div>
                <button type="submit" class="btn btn-dark" id="insert_debt">حفظ</button>
            </div>
        </form>

        <div class="image">
            <img src="<?= $image ?>Business Plan-amico1.png" alt="">
        </div>
    </div>
</section>

<script src="<?= $js . 'debt.js' ?>"></script>