<?php

if (!empty($_SESSION['error'])) {
    echo '<div class="alert alert-danger" role="alert"> ' . $_SESSION['error'] . '</div>';
    unset($_SESSION['error']);
}