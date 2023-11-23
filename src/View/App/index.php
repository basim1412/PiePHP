<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
} ?>

<div class="caroussel">
    <div class="diapo">
        <img src="/PiePHP/webroot/assets/cinema.jpg" id="slide" alt="caroussel">
    </div>
</div>