<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<h2>Détails du film</h2>
<p>{{ $movies['title'] }}</p>
<p>Réalisateur : {{ $movies['director'] }}</p>
<p>Date de sortie : {{ $movies['release_date'] }}</p>
<p>Duration : {{ $movies['duration'] }}</p>
<p>rating : {{ $movies['rating'] }}</p>

Genres:
@foreach ($movies['genre'] as $genre)
{{$genre['name']}}
@endforeach<br>

<a class="btn btn-secondary" href="javascript:history.back()">Retour</a>