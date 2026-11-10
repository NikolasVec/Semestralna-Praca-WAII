<?php
/** @var \Framework\Support\LinkGenerator $link */
/** @var \App\Models\EventYear|null $eventYear */

$eventYear = $eventYear ?? null;
$isEdit = $eventYear !== null;
?>

<section class="information">

    <h1>
        <?= $isEdit ? 'Upraviť ročník' : 'Pridať ročník' ?>
    </h1>

    <form method="post"
          action="<?= $link->url('eventYear.save') ?>">

        <?php if ($isEdit): ?>
            <input type="hidden"
                   name="id"
                   value="<?= e($eventYear->getId()) ?>">
        <?php endif; ?>

        <label for="year">Rok konania:</label>

        <input type="number"
               id="year"
               name="year"
               min="2000"
               max="2100"
               value="<?= e($eventYear?->getYear() ?? '') ?>"
               required>

        <button type="submit">
            <?= $isEdit ? 'Uložiť zmeny' : 'Pridať ročník' ?>
        </button>

    </form>

</section>


