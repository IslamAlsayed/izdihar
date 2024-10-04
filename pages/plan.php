<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update_plan'])) {
        $user_retirement_plan = selectRows('*', 'retirement_plan', "user_id=$user_id", '', '1');
    }
} else if (isset($_SESSION['plan_details'])) {
    header('Location: ./services.php?page=plan_details');
    exit();
}
?>

<section class="services-content">
    <div class="head">
        <h2 class="headSection">خطة التقاعد</h2>

        <p><b class="site_name">إزدهار</b> يهدف إلى مساعدتك في التخطيط لمستقبل مالي مريح بعد التقاعد. نحن نقدم استشارات متخصصة لمساعدتك في تحديد أهدافك التقاعدية وحساب المدخرات اللازمة لتحقيقها. من خلال أدوات تحليلية دقيقة، نساعدك على فهم كيف يمكن
            لمدخراتك واستثماراتك أن تؤثر على مستوى حياتك بعد التقاعد. انضم إلينا اليوم لضمان تحقيق راحة البال والاستقرار المالي في مرحلة ما بعد العمل..</p>
    </div>
    <div class="content">
        <div class="image">
            <img src="<?= $image  . 'do.jpeg' ?>" alt="">
        </div>

        <div class="form">
            <label class="error_validation"></label>
            <form id="insert_plan_form">
                <div class="group">
                    <input type="text" name="retirement_age" id="retirement_age" value="<?= $user_retirement_plan['retirement_age'] ?>" placeholder=" ">
                    <label for="retirement_age">السن المناسب للتقاعد</label>
                </div>
                <div class="group">
                    <input type="text" name="user_old" id="user_old" value="<?= $user_retirement_plan['user_old'] ?>" placeholder=" ">
                    <label for="user_old">كم عمرك الآن؟</label>
                </div>
                <div class="group">
                    <input type="text" name="monthly_amount" id="monthly_amount" value="<?= $user_retirement_plan['monthly_amount'] ?>" placeholder=" ">
                    <label for="monthly_amount">الدخل الشهري</label>
                </div>
                <div class="group">
                    <input type="text" name="goal_retirement" id="goal_retirement" value="<?= $user_retirement_plan['goal_retirement'] ?>" placeholder=" ">
                    <label for="goal_retirement">مقدار الهدف الذي تريد تحقيقه عند التقاعد</label>
                </div>
                <div class="group">
                    <input type="text" name="goal_type" id="goal_type" max="21" value="<?= $user_retirement_plan['goal_type'] ?>" placeholder=" ">
                    <label for="goal_type">نوع الهدف</label>
                </div>

                <div class="group">
                    <button type="submit" name="insert_plan" id="insert_plan" class="btn btn-dark">حفظ خطة التقاعد</button>
                </div>
            </form>
        </div>
    </div>
</section>