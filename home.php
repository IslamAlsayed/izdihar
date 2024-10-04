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
        <img src="<?= $image ?>mi.jpeg" alt="">
    </div>

    <div class="section-text">
        <h2 class="site_name">إزدهار</h2>

        <p>هو الحل الأمثل لإدارة شؤونك المالية والتخطيط لمستقبلك المالي بسهولة واحترافية. نحن نهدف إلى تمكينك من اتخاذ قرارات مالية مدروسة تضمن لك الرخاء المالي في جميع مراحل حياتك. من خلال أدواتنا المتطورة، نقدم لك تحليلات دقيقة وإرشادات واضحة
            لتحقيق أهدافك المالية. انضم إلينا اليوم وابدأ رحلتك نحو الاستقلال المالي والثقة في إدارة مواردك. مع <b class="site_name">إزدهار</b>، أنت دائمًا على الطريق الصحيح نحو مستقبل مشرق.</p>

        <div class="default-btn">
            <a href="./services.php?page=budget" class="btn btn-dark">البدأ</a>
        </div>
    </div>
</div>

<section class="site_goals">
    <h2 class="headSection">أهداف موقع "ازدهار"</h2>

    <div class="cards">
        <div class="card">
            <div class="icon">
                <i class="fas fa-chart-pie"></i>
            </div>

            <div class="text">
                تمكين الأفراد من اتخاذ قرارات مالية ذكية: يسعى الموقع إلى توفير الأدوات والمعلومات التي تساعد المستخدمين على فهم وضعهم المالي، مما يمكنهم من اتخاذ قرارات مالية أفضل وأكثر وعيًا.
            </div>
        </div>
        <div class="card">
            <div class="icon">
                <i class="fas fa-chart-column"></i>
            </div>

            <div class="text">
                مساعدة المستخدمين في تحقيق أهدافهم المالية: سواء كانت أهدافهم تتعلق بالادخار، الاستثمار، أو التخطيط للتقاعد، يوفر الموقع الأدوات والخطط التي تساعد على تحقيق هذه الأهداف بشكل مستدام وفعّال.
            </div>
        </div>
        <div class="card">
            <div class="icon">
                <i class="fas fa-ranking-star"></i>
            </div>

            <div class="text">
                دعم الاستقلال المالي: يهدف الموقع إلى مساعدة الأفراد في بناء استقلال مالي يمكنهم من الاعتماد على أنفسهم في اتخاذ القرارات المالية دون الحاجة إلى الاستعانة بمستشارين ماليين.
            </div>
        </div>
        <div class="card">
            <div class="icon">
                <i class="fas fa-chart-simple"></i>
            </div>

            <div class="text">
                تشجيع التخطيط الطويل الأمد: يركز الموقع على أهمية التخطيط للمستقبل من خلال تقديم أدوات مخصصة للتقاعد والاستثمار طويل الأمد، مما يساعد الأفراد على بناء ثروة مستدامة. </div>
        </div>
    </div>
</section>

<section class="site_goals site_helps_you">
    <h2 class="headSection">كيف يساعدك الموقع</h2>

    <div class="cards">
        <div class="card">
            <div class="icon">
                <i class="fas fa-chart-line"></i>
            </div>

            <div class="text">
                اتخاذ قرارات مالية أفضل : يقدم الموقع أدوات تحليلية تساعدك على فهم نمط إنفاقك وكيفية تحسينه.
            </div>
        </div>

        <div class="card">
            <div class="icon">
                <i class="fas fa-bullseye"></i>
            </div>

            <div class="text">
                تحقيق الأهداف المالية: سواء كان هدفك شراء منزل، سداد ديون، أو التخطيط للتقاعد، "ازدهار" يوفر لك الأدوات التي تحتاجها لتحقيق هذه الأهداف. </div>
        </div>

        <div class="card">
            <div class="icon">
                <i class="fas fa-slideshare"></i>
            </div>

            <div class="text">
                تعزيز الوعي المالي: من خلال موارد تعليمية وإرشادية
            </div>
        </div>
</section>

<section class="site_goals site_helps_you">
    <h2 class="headSection">للميزانية والتخطيط والتوقعات يتيح لك التركيز على عملك CCH Tagetik أسباب تجعل برنامج 3</h2>

    <div class="cards">
        <div class="card">
            <h3 class="title">توقع النتائج</h3>

            <div class="text">
                باستخدام التخطيط والتنبؤ التنيني، يمكنك تحويل مليارات الأسطر من البيانات العام إلى اتجاهات ورؤى يمكنها توفير الوقت والمال المنظمك </div>
        </div>

        <div class="card">
            <h3 class="title">فهم التأثيرات</h3>

            <div class="text">
                يمكنك التعمق في البيانات المنخفضة المستوى والتخطيط على أي مستوى لاستخدام محركات التفصيلية وتفصل المعلومات المالية والتشغيلية المتوافقة والأبعاد غير المحدودة التي يمكنك استكشافها، يمكنك التاج تحليل متعمق. الربحية </div>
        </div>

        <div class="card">
            <h3 class="title">اتخذ قرارا أسرع</h3>

            <div class="text">
                قم بتشريع وقت رد فعلك واتخاذ قرارات أسرع. تتيح لك عمليات المحاكاة القائمة على السائق في الوقت الفعلي والأئمنة المدمجة المرونة اللازمة للتخطيط الطريقك في أي وقت </div>
        </div>
    </div>
</section>

<?php include './includes/templates/footer.php'; ?>