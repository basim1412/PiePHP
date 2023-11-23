<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
} ?>
<h2>Nos Films</h2>
@foreach ($movies as $movie)
<p><a href="/PiePhp/movie/showDetail/{{ $movie['id'] }}">{{ $movie['title'] }}</a></p>
@endforeach