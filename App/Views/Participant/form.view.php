<?php
/** @var \App\Models\Participant|null $participant */
/** @var \Framework\Support\LinkGenerator $link */

$participant = $participant ?? null;
$isEdit = $participant !== null;
?>

<section class="registration">

    <h1>
        <?= $isEdit ? 'Upraviť účastníka' : 'Pridať účastníka' ?>
    </h1>

    <form class="registration-form"
          method="post"
          action="<?= $link->url('participant.save') ?>">

        <?php if ($isEdit): ?>
            <input type="hidden" name="id"
                   value="<?= e($participant->getId()) ?>">
        <?php endif; ?>

        <label for="first_name">Meno</label>
        <input type="text" id="first_name"
               name="first_name"
               value="<?= e($participant?->getFirstName() ?? '') ?>"
               required>

        <label for="last_name">Priezvisko</label>
        <input type="text" id="last_name"
               name="last_name"
               value="<?= e($participant?->getLastName() ?? '') ?>"
               required>

        <label for="email">E-mail</label>
        <input type="email" id="email"
               name="email"
               value="<?= e($participant?->getEmail() ?? '') ?>"
               required>

        <label for="birth_date">Dátum narodenia</label>
        <input type="date" id="birth_date"
               name="birth_date"
               value="<?= e($participant?->getBirthDate() ?? '') ?>"
               required>

        <label for="event_year_id">Rok konania</label>
        <input type="number" id="event_year_id"
               name="event_year_id" min="2000"
               value="<?= e($participant?->getEventYearId() ?? '') ?>"
               required>

        <label for="time">Dosiahnutý čas</label>
        <input type="time" id="time"
               name="time" step="1"
               value="<?= e($participant?->getTime() ?? '') ?>">

        <button type="submit">
            <?= $isEdit ? 'Uložiť zmeny' : 'Pridať účastníka' ?>
        </button>

    </form>

</section>
