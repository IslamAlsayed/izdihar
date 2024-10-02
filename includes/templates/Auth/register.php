<section class="authForm register">
    <div class="image">
        <img src="<?= $image ?>create.jpeg" alt="">
    </div>
    <div class="from">
        <h3><?= lang('WELCOME_BACK') ?> !</h3>
        <h2><?= lang('REGISTER_HEAD') ?></h2>

        <form autocomplete="off">
            <div class="group">
                <input type="number" name="username" id="username" placeholder=" " />
                <label for="username">username</label>
            </div>
            <div class="group">
                <input type="email" name="email" id="email" placeholder=" " />
                <label for="email">email</label>
            </div>
            <div class="groups">
                <div class="group">
                    <input type="password" name="password" id="password" placeholder=" " />
                    <label for="password">password</label>
                </div>
                <div class="group">
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder=" " />
                    <label for="password_confirmation">password confirmation</label>
                </div>
            </div>
            <div class="group">
                <select name="currency" id="currency">
                    <option value="">currency</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </div>

            <div class="links">
                <div class="remember_me">
                    <div class="checkbox-wrapper-12">
                        <div class="cbx">
                            <input type="checkbox" name="remember_me" id="remember_me">
                            <label for="cbx-12"></label>
                            <svg fill="none" viewBox="0 0 15 14" height="14" width="15">
                                <path d="M2 8.36364L6.23077 12L13 2"></path>
                            </svg>
                        </div>

                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <filter id="goo-12">
                                    <feGaussianBlur result="blur" stdDeviation="4" in="SourceGraphic"></feGaussianBlur>
                                    <feColorMatrix result="goo-12" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 22 -7" mode="matrix" in="blur"></feColorMatrix>
                                    <feBlend in2="goo-12" in="SourceGraphic"></feBlend>
                                </filter>
                            </defs>
                        </svg>
                    </div>

                    <label for="remember_me">remember me</label>
                </div>
                <a href="#" class="forget_password"><?= lang('FORGET_PASSWORD') ?> ?</a>
            </div>

            <div class="group">
                <button type="submit" class="btn btn-main">submit</button>
            </div>

            <div class="create_account">
                <span>don't have an account?</span>
                <a href="./account.php?page=register">create account</a>
            </div>
        </form>
    </div>
</section>


<!-- <div class="account-page" id="account-page">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6" style="padding:0">
                <div class="img">
                    <img src="<?= $image ?>create.jpeg" alt="" style="margin-top: 50px;width:80%">
                </div>
            </div>
            <div class="col-md-6">
                <div class="login-page">

                    <form class="register-form" action="#" method="post" id="form-info" style="text-align:center">

                        <h4 style="text-align: center; font-weight: bold"> <?= lang('HELLO') ?> !</h4>
                        <h3 dir="" style="color: rgba (0،0،0، .6)"><?= lang('REGISTER_HEAD') ?></h3>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="text" name="firstName" class="form-control col-md-12" placeholder="firstName" autocomplete="off" required="required">

                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" name="lastName" class="form-control col-md-12" placeholder="lastName" autocomplete="off" required="required">

                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" name="username" class="form-control col-md-12" placeholder="username" autocomplete="off" required="required">

                            </div>

                            <div class="form-group col-md-6">
                                <input type="text" name="email" class="form-control col-md-12" placeholder="email adress" autocomplete="off" required="required">

                            </div>
                            <div class="form-group col-md-6">
                                <input type="password" name="password" class="form-control col-md-12" placeholder="password" autocomplete="off" required="required">

                            </div>
                            <div class="form-group col-md-6">
                                <input type="password" name="cpassword" class="form-control col-md-12" placeholder="confirm password" autocomplete="off" required="required">

                            </div>

                        </div>


                        <div class="form-group">
                            <input id="a-btn-option" type="button" class="btn btn-primary" value="Create account">

                        </div>
                        <div class="err-msg" id="err-msg">

                        </div>
                        <div class="new-acc" style="text-align:left;color:black">
                            already have an account ? <a href="./account.php?page=signin" class="ald-acc new-acc">Sign in</a>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div> -->