<?php $articles = selectRows('*', 'educational_material', '', '', '*');  ?>

<?php if (!isset($_GET['id'])) { ?>
<section class="services-content educational _<?= $key ?>">
    <h2 class="headSection">التعليم والتوجيه</h2>

    <h2 class="supHeadSection">-: الفيديوهات</h2>
    <div class="news">
        <div class="new">
            <div class="video">
                <iframe src="https://www.youtube.com/embed/Ru-yBS7wXEU?si=cknu1AUuyxjbhQ8g" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
            <div class="text">
                <div class="title">التخطيط المالي</div>
                <div class="description"></div>
            </div>
        </div>
        <div class="new">
            <div class="video">
                <iframe src="https://www.youtube.com/embed/erADTfaK9Pk?si=QVJSQfN2AJqC7M5f" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
            <div class="text">
                <div class="title">كيف تخطط لحياتك المالية؟</div>
                <div class="description"></div>
            </div>
        </div>
        <div class="new">
            <div class="video">
                <iframe src="https://www.youtube.com/embed/reHvsmSHzhY?si=91afDytwTBxNUawg" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
            <div class="text">
                <div class="title">كيف تكتفي مالياً؟ مع صلاح خاشقجي</div>
                <div class="description"></div>
            </div>
        </div>
    </div>
</section>

<section class="services-content educational">
    <h2 class="supHeadSection">-: الكتب</h2>

    <div class="cards">
        <div class="card">
            <div class="image">
                <img src="<?= $education . 'التخطيط-المالي.jpeg' ?>" alt="">
            </div>
            <div class="text">
                <div class="title">التخطيط-المالي</div>
                <a href="" class="download">download <i class="fas fa-download"></i></a>
            </div>
        </div>

        <div class="card">
            <div class="image">
                <img src="<?= $education . 'التخطيط المالي في الاستقرار.jpeg' ?>" alt="">
            </div>
            <div class="text">
                <div class="title">التخطيط المالي في الاستقرار</div>
                <a href="" class="download">download <i class="fas fa-download"></i></a>
            </div>
        </div>

        <div class="card">
            <div class="image">
                <img src="<?= $education . 'الاب الروحي.jpeg' ?>" alt="">
            </div>
            <div class="text">
                <div class="title">الاب الروحي</div>
                <a href="" class="download">download <i class="fas fa-download"></i></a>
            </div>
        </div>

        <div class="card">
            <div class="image">
                <img src="<?= $education . 'الإدارة المالية فى الإسلام2.png' ?>" alt="">
            </div>
            <div class="text">
                <div class="title">الإدارة المالية فى الإسلام2</div>
                <a href="" class="download">download <i class="fas fa-download"></i></a>
            </div>
        </div>

        <div class="card">
            <div class="image">
                <img src="<?= $education . 'الإدارة المالية دليل المعايير والتنفيذ.png' ?>" alt="">
            </div>
            <div class="text">
                <div class="title">الإدارة المالية دليل المعايير والتنفيذ</div>
                <a href="" class="download">download <i class="fas fa-download"></i></a>
            </div>
        </div>
    </div>
</section>

<section class="services-content educational">
    <h2 class="supHeadSection">-: المقالات</h2>
    <div class="cards">
        <?php foreach ($articles as $single_article) { ?>
        <div class="card">
            <div class="image">
                <img src="<?= $article . $single_article['image'] ?>" alt="">
            </div>
            <div class="text">
                <h4 class="title"><?= $single_article['title'] ?></h4>
                <hp class="description"><?= mb_strimwidth($single_article['description'], 0, 100, "...") ?></hp>
            </div>

            <a href="./services.php?page=education&id=<?= $single_article['id'] ?>" class="btn btn-dark more">
                <span>read more</span>
            </a>
        </div>
        <?php } ?>
    </div>
</section>

<?php } elseif (isset($_GET['id'])) {
    $article_id = $_GET['id'];
    $single_article = selectRows('*', 'educational_material', "id=$article_id", '', '1');
    $other_article = selectRows('*', 'educational_material', "id!=$article_id", '', '5');
?>
<section class="services-content educational">
    <div class="article">
        <div class="image">
            <img src="<?= $article . $single_article['image'] ?>" alt="">
        </div>
        <div class="text">
            <h4 class="title"><?= $single_article['title'] ?></h4>
            <p class="description"><?= $single_article['description'] ?></p>
        </div>
    </div>
</section>

<section class="services-content educational">
    <h2 class="supHeadSection">-: مقالات أخري</h2>
    <div class="cards">
        <?php foreach ($other_article as $single_article) { ?>
        <div class="card">
            <div class="image">
                <img src="<?= $article . $single_article['image'] ?>" alt="">
            </div>
            <div class="text">
                <h4 class="title"><?= $single_article['title'] ?></h4>
                <hp class="description"><?= mb_strimwidth($single_article['description'], 0, 100, "...") ?></hp>
            </div>

            <a href="./services.php?page=education&id=<?= $single_article['id'] ?>" class="btn btn-dark more">
                <span>read more</span>
            </a>
        </div>
        <?php } ?>
    </div>
</section>
<?php } ?>