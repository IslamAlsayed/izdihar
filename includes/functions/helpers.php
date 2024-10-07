<?php

function getTitle()
{
    global $pageTitle;
    echo isset($pageTitle) ? $pageTitle : 'Default';
}

function setActive($url)
{
    $activePage = basename($_SERVER['PHP_SELF'], ".php");
    return ($activePage == $url) ? 'active' : '';
}

function setPageActive($page)
{
    return isset($_GET['page']) && ($_GET['page'] == $page || $_GET['page'] == $page . '_details' || $_GET['page'] == $page) ? 'active' : '';
}

function setFlashMessage($status, $message)
{
    $_SESSION['flash_message'] = ['status' => $status, 'message' => $message];
}

function getFlashMessage()
{
    if (isset($_SESSION['flash_message'])) {
        $flash = $_SESSION['flash_message'];
        unset($_SESSION['flash_message']);
        return $flash;
    }
    return null;
}
