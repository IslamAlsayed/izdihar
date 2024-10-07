<?php
$pageTitle = 'الخدمات';
include 'init.php';
$user_id = '';

if ($_SESSION['user_id']) {
    $user_id = $_SESSION['user_id'];
}

if (!isset($user_id)) {
    header('Location: ./');
    exit();
}

$page = isset($_GET['page']) ? $_GET['page'] : header('Location: .//services.php?page=services');
?>

<?php
if ($page == 'services') {

    include './pages/services.php';
} else if ($page == 'offers') {

    include './pages/offers.php';
} else if ($page == 'education') {

    include './pages/education.php';
} elseif ($page == 'budget') {

    include './pages/budget.php';
} elseif ($page == 'budget_chart') {

    include './pages/budget_chart.php';
} elseif ($page == 'debts') {

    include './pages/debts.php';
} elseif ($page == 'debts_details') {

    include './pages/debts_details.php';
} elseif ($page == 'plan') {

    include './pages/plan.php';
} elseif ($page == 'plan_chart') {

    include './pages/plan_chart.php';
} elseif ($page == 'contact') {

    include './pages/contact.php';
} elseif ($page == 'privacy') { ?>

    <section class="services-content">
        <div class="head">
            <h2 class="headSection">privacy</h2>
            <p><?= $site['privacy'] ?></p>
        </div>
    </section>

<?php } elseif ($page == 'conditions') { ?>

    <section class="services-content">
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
?>