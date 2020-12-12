<?php

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['admin'])) {
    require __DIR__ . '/22.1.ab-list-admin.php';
} else {
    require __DIR__ . '/22.2.ab-list-noadmin.php';
}
