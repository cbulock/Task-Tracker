<?php

setcookie('user', $_GET['id'], time() + (86400 * 365), '/');

header('Location: /');