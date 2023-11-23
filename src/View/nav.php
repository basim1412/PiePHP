<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/PiePHP/">My Cinema</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/PiePHP/">Accueil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/PiePhp/movie/show">Films</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/PiePhp/genre/show">Genres</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/PiePHP/user">Profil</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <?php if (($_SESSION['id'] ?? null) != null) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="/PiePHP/user/logout">Déconnexion</a>
                </li>
            <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link" href="/PiePHP/user/login">Connexion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/PiePHP/user/register">Inscription</a>
                </li>
            <?php } ?>
        </ul>
    </div>
</nav>