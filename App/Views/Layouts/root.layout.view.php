
<?php
/** @var string $contentHTML */
/** @var \Framework\Support\LinkGenerator $link */
/** @var \Framework\Security\User $user */
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

            <?php if ($user->isLoggedIn()): ?>

                <!-- Navigacia administratora -->
                <a href="<?= $link->url('admin.index') ?>">
                    ADMIN PANEL
                </a>

                <a href="<?= $link->url('eventYear.index') ?>">
                    ROČNÍKY
                </a>

                <a href="<?= $link->url('participant.index') ?>">
                    ÚČASTNÍCI
                </a>

            <?php else: ?>

                <!-- Navigacia bezneho navstevnika -->
                <a href="<?= $link->url('home.registration') ?>">
                    REGISTRÁCIA
                </a>

                <a href="#">MAPA</a>
                <a href="#">VÝSLEDKY</a>
                <a href="#">GALÉRIA</a>

            <?php endif; ?>

        </nav>

    </aside>

    <!-- Obsah konkretnej stranky -->
    <main class="main-content">
        <?= $contentHTML ?>
    </main>

</div>

<!-- Paticka -->
<footer class="footer">


    <a class="admin-link footer-auth-link"
       href="<?= $user->isLoggedIn()
               ? $link->url('auth.logout')
               : \App\Configuration::LOGIN_URL ?>"
       title="<?= $user->isLoggedIn()
               ? 'Odhlásiť sa'
               : 'Prihlásiť sa' ?>"
       aria-label="<?= $user->isLoggedIn()
               ? 'Odhlásiť sa'
               : 'Prihlásiť sa' ?>">

        <!-- Ikona panacika -->
        <svg viewBox="0 0 24 24" aria-hidden="true">
            <circle cx="12" cy="7" r="5" fill="white"/>
            <path d="M2 22 C2 12, 22 12, 22 22 Z" fill="white"/>
        </svg>

        <!-- Sipka sa zobrazi iba prihlasenemu -->
        <?php if ($user->isLoggedIn()): ?>
            <svg class="logout-arrow"
                 xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 24 24"
                 aria-hidden="true">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                <polyline points="16 17 21 12 16 7"/>
                <line x1="21" y1="12" x2="9" y2="12"/>
            </svg>
        <?php endif; ?>

    </a>


    <p>© 2026 Beh po pivo. Všetky práva vyhradené.</p>

</footer>

</body>
</html>
