<?php
$user_debts = selectRows('*', 'debt', "user_id=$user_id", '', '*');

$total_debt_amount = 0;
$total_debt_monthly = 0;

foreach ($user_debts as $debt) {
    $total_debt_amount += isset($debt['debt_amount']) ? $debt['debt_amount'] : 0;
    $total_debt_monthly += isset($debt['debt_monthly']) ? $debt['debt_monthly'] : 0;
}
?>

<section class="debt_details">
    <h2 class="headSection">خطة سداد الديون</h2>
    <table>
        <thead>
            <tr>
                <th>نوع الدين</th>
                <th>إجمالي مبلغ الدين</th>
                <th>الدين المتكلف</th>
                <th>المدة</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($user_debts as $debt) { ?>
            <tr>
                <td><?= $debt['debt_type'] ?></td>
                <td><?= $debt['debt_amount'] . ' '  . $_SESSION['currency'] ?></td>
                <td><?= $debt['debt_monthly'] . ' '  . $_SESSION['currency'] ?></td>
                <td><?= $debt['duration']; ?></td>
                <?php } ?>
            </tr>
            <tr>
                <td>--</td>
                <td><b class="site_name">total <?= $total_debt_amount . ' '  . $_SESSION['currency'] ?> </b></td>
                <td><b class="site_name">total <?= $total_debt_monthly . ' '  . $_SESSION['currency'] ?></b></td>
                <td>--</td>
            </tr>
        </tbody>
    </table>
</section>