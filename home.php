<?php
$pageTitle = 'الصفحة الرئيسية';
include 'init.php';

if (!isset($_SESSION['username'])) {
    header('Location: ./');
    exit();
}
?>

<div class="homeSection_1 section">
    <div class="section-image">
        <img src="<?= $image ?>Revenue-pana.png" alt="">
    </div>

    <div class="section-text">
        <h2 class="site_name">إزدهار</h2>

        <p>الحل الأمثل لإدارة شؤونك المالية والتخطيط لمستقبلك المالي بكل سهولة واحترافية. هدفنا هو تمكينك من اتخاذ قرارات مالية مستنيرة تضمن لك الرخاء المالي في كل مرحلة من مراحل حياتك.</p>

        <div class="default-btn">
            <a href="./services.php?page=budget" class="btn btn-dark">البدأ الأن</a>
        </div>
    </div>
</div>

<div class="homeSection_1 section">
    <div class="section-text">
        <h2 class="site_name">ماهــو ازدهــــار </h2>

        <p> هو موقع يختص في التخطيط المالي يساعدك على وضع خطة مالية مبسطة تُمكنك من فهم وإدارة شؤونك المالية بوضوح. نقدم أدوات لإعداد الميزانية و تحديد أهدافك المالية و التخطيط لتقاعد مريح ووضع خطة فعالة لسداد ديونك. كما نوفر لك مجموعة من الكتب
            والمقالات التي تساهم في زيادة الوعي المالي وتوجيهك نحو خطوات مدروسة لبناء مستقبل مالي أفضل.</p>
    </div>

    <div class="section-image">
        <img src="<?= $image ?>Questions-pana.png" alt="">
    </div>
</div>

<div class="homeSection_2">
    <div class="head">
        <h2>أهداف ازدهار</h2>
        <div class="image">
            <img src="<?= $image ?>Target-amico.png" alt="">
        </div>
    </div>

    <div class="cards">
        <div class="card">
            <div class="image">
                <img src="<?= $image . 'Shared goals-amico.png' ?>" alt="">
            </div>
            <div class="text">تمكين الأفراد من اتخاذ قرارات مالية ذكية</div>
        </div>
        <div class="card">
            <div class="image">
                <img src="<?= $image . 'Goal-bro.png' ?>" alt="">
            </div>
            <div class="text">دعم الاستقلال المالي</div>
        </div>
        <div class="card">
            <div class="image">
                <img src="<?= $image . 'Investing-pana.png' ?>" alt="">
            </div>
            <div class="text">تشجيع التخطيط الطويل الأمد</div>
        </div>
        <div class="card">
            <div class="image">
                <img src="<?= $image . 'Personal finance-pana.png' ?>" alt="">
            </div>
            <div class="text"> تحقيق أهداف رؤية تطوير القطاع المالي في المملكة العربية السعودية لعام 2030.</div>
        </div>
    </div>
</div>

<div class="homeSection_2">
    <div class="head">
        <h2>خــدماتــنا</h2>
        <div class="image">
            <img src="<?= $image . 'Devices-amico.png' ?>" alt="">
        </div>
    </div>

    <div class="cards">
        <div class="card">
            <h3>الاهداف</h3>

            <div class="content">
                <img src="<?= $image . 'Paid idea-bro.png' ?>" alt="">
                <p>خدمة الاهداف تتيح للمستخدم اختيار هدف مستقبل وتقدم له خطة لسير نحو تخقيق الهدف</p>
            </div>
        </div>
        <div class="card">
            <h3>اعداد الميزانية</h3>

            <div class="content">
                <p>تتيح الخدمة تحليل الدخل والنفقات وتوزيع الأموال بطريقة تضمن تحقيق أهداف مالية واضحة، سواء كانت لتوفير، أو حتى التحكم في المصاريف اليومي</p>
            </div>
        </div>
        <div class="card">
            <h3>العروض الاستثمارية</h3>

            <div class="content">
                <img src="<?= $image . 'Banknote-bro.png' ?>" alt="">
                <p>قريبًا سنقدم مجموعة من العروض الاستثمارية لمساعدتك في تنمية أموالك. من خلال توفير للفرص الاستثمارية المتاحة التي تحقق لك عوائد مالية جيدة.</p>
            </div>
            <div class="button">
                <button class="btn btn-dark active">قريبا</button>
            </div>
        </div>
        <div class="card">
            <h3>ادارة الديون</h3>

            <div class="content">
                <p>تتيح الخدمة تبسيط سداد الدين للمستخدم حيث تعرض مبلغد الدين و القسط والمدة وتحديد عند انتهائه</p>
            </div>
        </div>
        <div class="card">
            <h3>خطة التقاعد</h3>

            <div class="content">
                <img src="<?= $image . 'Grandma-pana.png' ?>" alt="">
                <p>توفر الخدمة اهداف مستقبلة لما بعد التقاعد حيث يتم حساب ما يريد المستخدم الوصول اليه ويتم تحديد ما القيمة التي سيصل اليها</p>
            </div>
        </div>
        <div class="card">
            <h3>خطة التقاعد</h3>

            <div class="content">
                <img src="<?= $image . 'Data extraction-amico.png' ?>" alt="">
                <p>نتيح الخدمة عدة مصارد لتعلم التخطيط المالي </p>
            </div>
        </div>
    </div>
</div>

<section class="site_goals">
    <h2>مـــزايا أزدهــــار</h2>

    <div class="cards">
        <div class="card">
            <div class="icon">
                <i class="fas fa-desktop"></i>
            </div>

            <p>متوافق مع جميع الاجهزه</p>
        </div>
        <div class="card">
            <div class="icon">
                <span>easy</span>
                <i class="fas fa-hand-holding"></i>
            </div>

            <p>سهل الاستخدام</p>

        </div>
        <div class="card">
            <div class="icon">
                <span>24</span>
                <i class="fas fa-headset"></i>
            </div>

            <p>يمكن الوصول إليها</p>
        </div>
    </div>
</section>

<?php include './includes/templates/footer.php'; ?>