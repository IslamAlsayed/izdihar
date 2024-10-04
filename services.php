<?php
ob_start();
$pageTitle = 'Services page';
include 'init.php';

if (!isset($_SESSION['username'])) {
    header('Location: ./');
    exit();
}

$page = isset($_GET['page']) ? $_GET['page'] : 'services';
$user_id = $_SESSION['user_id'];
$user_budget = selectRows('*', 'budget', "id=$user_id", '', '1');
$key = $_GET['page'] ?? '1';
?>

<?php if ($page == 'offers') {

    include './pages/offers.php';
} else if ($page == 'education') {

    include './pages/education.php';
} elseif ($page == 'plan') {

    include './pages/plan.php';
} elseif ($page == 'plan_details') {

    include './pages/plan_details.php';
} elseif ($page == 'services') {

    include './pages/services.php';
} elseif ($page == 'add_debt') {

    include './pages/add_debt.php';
} elseif ($page == 'debts_details') {

    include './pages/debts_details.php';
} elseif ($page == 'budget') {

    include './pages/budget.php';
} elseif ($page == 'add_budget') {

    include './pages/add_budget.php';
} elseif ($page == 'contact') {

    include './pages/contact.php';
} elseif ($page == 'privacy') { ?>

    <section class="services-content _<?= $key ?>">
        <div class="head">
            <h2 class="headSection">privacy</h2>
            <p><?= $site['privacy'] ?></p>
        </div>
    </section>

<?php } elseif ($page == 'conditions') { ?>

    <section class="services-content _<?= $key ?>">
        <div class="head">
            <h2 class="headSection">Terms & & conditions</h2>
            <p><?= $site['conditions'] ?></p>
        </div>
    </section>

<?php } else {
    header('Location:./services.php?page=services');
    exit();
}
include './includes/templates/footer.php';
ob_end_flush();
?>