<?php $videos = selectRows('*', 'educational_material', "type='video'", '', '*');  ?>
<?php $books = selectRows('*', 'educational_material', "type='book'", '', '*');  ?>
<?php $articles = selectRows('*', 'educational_material', "type='article'", '', '*');  ?>

<?php if (!isset($_GET['id'])) { ?>
    <section class="services-content educational _<?= $key ?>">
        <div class="head">
            <h2 class="headSection">التعليم والتوجيه</h2>

            <p><b class="site_name">إزدهار</b> يهدف إلى تزويدك بالمعرفة والأدوات اللازمة لتحقيق النجاح المالي. نحن نقدم برامج تعليمية متنوعة تشمل ورش عمل ودورات تدريبية تغطي مواضيع مثل التخطيط المالي، إدارة النفقات، والاستثمار. من خلال التوجيه المستمر
                من خبرائنا، نساعدك على فهم
                الجوانب المختلفة لإدارة الأموال، مما يمكنّك من اتخاذ قرارات مالية مستنيرة. انضم إلينا واكتسب المهارات اللازمة لبناء مستقبل مالي مستقر ومزدهر.</p>
        </div>

        <h2 class="supHeadSection">-: الفيديوهات</h2>
        <div class="news">

            <?php foreach ($videos as $video) { ?>
                <div class="new">
                    <div class="video">
                        <iframe src="<?= $video['link'] ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                    <div class="text">
                        <div class="title"><b><?= $video['title'] ?></b></div>
                        <div class="description"><?= $video['description'] ?></div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>

    <section class="services-content educational">
        <h2 class="supHeadSection">-: الكتب</h2>

        <div class="cards">
            <?php foreach ($books as $book) { ?>
                <div class="card">
                    <div class="image">
                        <img src="<?= $education . $book['link'] ?>" alt="">
                    </div>
                    <div class="text">
                        <div class="title"><?= $education . $book['title'] ?></div>
                        <a href="<?= $education . $book['link'] ?>" download class="download">download <i class="fas fa-download"></i></a>
                    </div>
                </div>
            <?php } ?>
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