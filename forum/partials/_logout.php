<?php
session_start();

echo "Logging you out please wait...";
header("Location: /forum");
session_destroy();