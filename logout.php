<?php

session_start();

session_destroy();

header("Location: _user-login.php");
exit;