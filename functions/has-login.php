<?php 
    if (isset($_SESSION['username']) && isset($_SESSION['role_id'])) {
        header('Location: home');
    }
