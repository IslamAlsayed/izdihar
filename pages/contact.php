<section class="services-content _<?= $key ?>">
    <div class="head">
        <h2 class="headSection">Contact us</h2>
        <p>Please let us know if you have any questions, want to leave us a comment, or would like to learn more about us</p>
    </div>

    <div class="content">
        <div class="image">
            <img src="<?= $image  . 'mi.jpeg' ?>" alt="">
        </div>
        <div class="form">
            <form action="">
                <div class="group">
                    <i class="fas fa-envelope"></i>
                    <input type="text" name="email" id="email" placeholder=" " required>
                </div>
                <div class="group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" id="username" placeholder=" " required>
                </div>
                <div class="group">
                    <i class="fab fa-whatsapp"></i>
                    <input type="text" name="whats" id="whats" placeholder=" " required>
                </div>
                <div class="group">
                    <textarea name="message" id="message" placeholder=" " required></textarea>
                    <label for="message">message</label>
                </div>

                <div class="group">
                    <button type="submit" disabled class="btn btn-dark">save</button>
                </div>
            </form>
        </div>
    </div>

    <div class="contact-tool">
        <div class="col">
            <span>mobile whatsapp</span>
            <a href="mailto:"><?= $site['phone'] ?></a>
        </div>
        -
        <div class="col">
            <span>email address</span>
            <!-- <a href="mailto:" class="email">email@gmail.com</a> -->
            <a href="mailto:" class="email"><?= $site['email'] ?></a>
        </div>
    </div>
</section>