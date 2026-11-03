<?php
/** @var \Framework\Support\LinkGenerator $link */
/** @var \App\Models\EventYear[] $years */
?>

<!-- Registracna sekcia -->
<section class="registration">

    <h1>Registrácia</h1>

    <form class="registration-form"
          method="post"
          action="<?= $link->url('participant.save') ?>">

        <input type="hidden" name="registration_source" value="public">

        <label for="first-name">Meno</label>
        <input type="text" id="first-name" name="first_name" required>

        <label for="last-name">Priezvisko</label>
        <input type="text" id="last-name" name="last_name" required>

        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" required>

        <label for="birth-date">Dátum narodenia</label>
        <input type="date" id="birth-date" name="birth_date" required>

        <button type="submit">REGISTROVAŤ SA</button>

    </form>

</section>
