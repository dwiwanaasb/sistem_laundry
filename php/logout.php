<?php

session_destroy();
unset($_SESSION["total_harga"]);
unset($_SESSION["metode_pembayaran"]);

header("Location: ../index.html");
