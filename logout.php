<?php
session_start();
session_destroy();
session_gc();
exit(header('location: login_form.php'));