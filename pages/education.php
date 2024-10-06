<?php $videos = selectRows('*', 'education', "type='video'", '', '*');  ?>
<?php $books = selectRows('*', 'education', "type='book'", '', '*');  ?>

<section class="services-education">
    <h2>مصادر تعليمية</h2>

    <div class="education-videos">
        <h2>مقاطع الفديو</h2>

        <div class="videos">
            <?php foreach ($videos as $video) { ?>
                <div class="video">
                    <iframe src="<?= $video['link'] ?>" frameborder="0"></iframe>
                    <h3><?= $video['title'] ?></h3>
                    <a href="#" class="btn btn-dark">تتبع</a>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="education-books">
        <h2>الكتب</h2>

        <div class="books">
            <?php foreach ($books as $book) { ?>
                <div class="book">
                    <img src="<?= $education . $book['link'] ?>" alt="" />
                    <h3><?= $book['title'] ?></h3>
                    <a href="#" class="btn btn-dark">تتبع</a>
                </div>
            <?php } ?>
        </div>
    </div>
</section>