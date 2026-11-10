
<?php
/** @var \Framework\Support\LinkGenerator $link */
/** @var \App\Models\EventYear $eventYear */
/** @var \App\Models\Participant[] $participants */
?>

<section class="information">

    <h1>Ročník <?= e($eventYear->getYear()) ?></h1>

    <p>
        Počet účastníkov:
        <?= e($eventYear->getPocetUcastnikov()) ?>
    </p>

    <h2>Zoznam účastníkov</h2>

    <a class="participant-btn"
       href="<?= $link->url('participant.add', [
           'event_year_id' => $eventYear->getId(),
           'return_year_id' => $eventYear->getId()
       ]) ?>">
        Pridať účastníka
    </a>

    <table border="1" cellpadding="10">
        <tr>
            <th>Meno</th>
            <th>Priezvisko</th>
            <th>E-mail</th>
            <th>Čas</th>
            <th>Akcie</th>
        </tr>

        <?php foreach ($participants as $participant): ?>
            <tr>
                <td><?= e($participant->getFirstName()) ?></td>
                <td><?= e($participant->getLastName()) ?></td>
                <td><?= e($participant->getEmail()) ?></td>
                <td>
                    <?= e($participant->getTime() ?? 'Bez výsledku') ?>
                </td>
                <td>
                    <a class="participant-btn"
                       href="<?= $link->url('participant.edit', [
                           'id' => $participant->getId(),
                           'return_year_id' => $eventYear->getId()
                       ]) ?>">
                        Upraviť
                    </a>

                    <form method="post"
                          action="<?= $link->url('participant.delete') ?>"
                          style="display: inline;"
                          onsubmit="return confirm('Naozaj chceš vymazať tohto účastníka?');">

                        <input type="hidden"
                               name="id"
                               value="<?= e($participant->getId()) ?>">

                        <input type="hidden"
                               name="return_year_id"
                               value="<?= e($eventYear->getId()) ?>">

                        <button type="submit" class="participant-btn">
                            Vymazať
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <?php if (empty($participants)): ?>
        <p>Tento ročník zatiaľ nemá žiadnych účastníkov.</p>
    <?php endif; ?>

    <p>
        <a class="participant-btn"
           href="<?= $link->url('eventYear.index') ?>">
            Späť na ročníky
        </a>
    </p>

</section>
