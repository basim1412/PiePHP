<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// var_dump($genres);
?>

<h2>Film</h2>

Genres:
@foreach ($genres['movie'] as $genre)
{{$genre['title']}} <br>
@endforeach<br>

<a class="btn btn-secondary" href="javascript:history.back()">Retour</a>