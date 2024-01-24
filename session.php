<?php
// Mengatur waktu kadaluarsa sesi menjadi 1 jam
$expire = 60 * 60; // 1 jam
session_set_cookie_params($expire);
session_start();
