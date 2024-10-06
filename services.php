<?php
$pageTitle = 'الخدمات';
include 'init.php';

if (!isset($_SESSION['username'])) {
    header('Location: ./');
    exit();
}

$page = isset($_GET['page']) ? $_GET['page'] : header('Location: .//services.php?page=services');
$user_id = $_SESSION['user_id'];
?>

<?php
if ($page == 'services') {

    include './pages/services.php';
} else if ($page == 'offers') {

    include './pages/offers.php';
} else if ($page == 'education') {

    include './pages/education.php';
} elseif ($page == 'budget') { //? done

    include './pages/budget.php'; //? done
} elseif ($page == 'budget_chart') { //? done

    include './pages/budget_chart.php'; //? done
} elseif ($page == 'debts') { //? done

    include './pages/debts.php'; //? done
} elseif ($page == 'debts_details') { //? done

    include './pages/debts_details.php'; //? done
} elseif ($page == 'plan') { //? done

    include './pages/plan.php'; //? done
} elseif ($page == 'plan_chart') { //? done

    include './pages/plan_chart.php'; //? done
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