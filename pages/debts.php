<section class="services-content _<?= $key ?>">
    <h2 class="headSection">إدارة الديون</h2>

    <div class="content">
        <div class="image">
            <img src="<?= $image  . 'do.jpeg' ?>" alt="">
        </div>
        <div class="form">
            <label class="error_validation"></label>
            <form id="insert_debt_form">
                <div class="group">
                    <input type="text" name="debt_type" id="debt_type" placeholder=" ">
                    <label for="debt_type">نوع الدين</label>
                </div>
                <div class="group">
                    <input type="text" name="debt_amount" id="debt_amount" placeholder=" ">
                    <label for="debt_amount">إجمالي مبلغ الدين</label>
                </div>
                <div class="group">
                    <input type="text" name="debt_monthly" id="debt_monthly" placeholder=" ">
                    <label for="debt_monthly">القسط الشهري</label>
                </div>
                <div class="group">
                    <input type="text" name="duration" id="duration" placeholder=" ">
                    <label for="duration">الفترة المتبقية للسداد بالشهر</label>
                </div>

                <div class="group">
                    <button type="submit" name="insert_debt" id="insert_debt" class="btn btn-dark">خطة السداد</button>
                </div>
            </form>
        </div>
    </div>
</section>