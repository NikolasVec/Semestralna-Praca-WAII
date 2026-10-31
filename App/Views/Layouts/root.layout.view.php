
<?php
/** @var string $contentHTML */
/** @var \Framework\Support\LinkGenerator $link */
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beh po pivo</title>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $link->asset('css/style.css') ?>">
</head>
<body>

<div class="page-container">

    <!-- Bocny navigacny panel -->
    <aside class="sidebar">

        <div class="logo">
            <a href="<?= $link->url('home.index') ?>">
                <img src="<?= $link->asset('images/LogoOBR.png') ?>"
                     alt="Logo Beh po pivo">
            </a>
        </div>

        <nav class="navigation" aria-label="Hlavná navigácia">
            <a href="<?= $link->url('home.registration') ?>">REGISTRÁCIA</a>
            <a href="#">MAPA</a>
            <a href="#">VÝSLEDKY</a>
            <a href="#">GALÉRIA</a>
        </nav>

    </aside>

    <!-- Obsah konkretnej stranky -->
    <main class="main-content">
        <?= $contentHTML ?>
    </main>

</div>

<!-- Paticka -->
<footer class="footer">

    <a href="<?= App\Configuration::LOGIN_URL ?>"
       class="admin-link"
       aria-label="Prihlásenie administrátora">
        <svg viewBox="0 0 24 24" aria-hidden="true">
            <circle cx="12" cy="7" r="5" fill="white"/>
            <path d="M2 22 C2 12, 22 12, 22 22 Z" fill="white"/>
        </svg>
    </a>

    <p>© 2026 Beh po pivo. Všetky práva vyhradené.</p>

</footer>

</body>
</html>
