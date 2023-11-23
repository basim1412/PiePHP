<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
} ?>
<h2>Genres</h2>
@foreach ($genres as $genre)
<p><a href="/PiePhp/genre/showDetail/{{ $genre['id'] }}">{{ $genre['name'] }}</a></p>
@endforeach