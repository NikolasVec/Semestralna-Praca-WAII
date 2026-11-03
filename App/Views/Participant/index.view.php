
<?php
/** @var \App\Models\Participant[] $participants */
/** @var \Framework\Support\LinkGenerator $link */
?>

<section class="information">
    <h1>Zoznam účastníkov</h1>

    <a href="<?= $link->url('participant.add') ?>">
        Pridať účastníka
    </a>

    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Meno</th>
            <th>Priezvisko</th>
            <th>E-mail</th>
            <th>Dátum narodenia</th>
            <th>Rok</th>
            <th>Čas</th>
            <th>Akcie</th>
        </tr>

        <?php foreach ($participants as $participant): ?>
            <tr>
                <td><?= e($participant->getId()) ?></td>
                <td><?= e($participant->getFirstName()) ?></td>
                <td><?= e($participant->getLastName()) ?></td>
                <td><?= e($participant->getEmail()) ?></td>
                <td><?= e($participant->getBirthDate()) ?></td>
                <td><?= e($participant->getEventYearId()) ?></td>
                <td><?= e($participant->getTime()) ?></td>

                <td>
                    <a href="<?= $link->url('participant.edit',
                        ['id' => $participant->getId()]) ?>">
                        Upraviť
                    </a>

                    <form method="post"
                          action="<?= $link->url('participant.delete') ?>"
                          style="display: inline;"
                          onsubmit="return confirm('Naozaj chceš vymazať tohto účastníka?');">

                        <input type="hidden"
                               name="id"
                               value="<?= e($participant->getId()) ?>">

                        <button type="submit">Vymazať</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <?php if (empty($participants)): ?>
        <p>Zatiaľ nie sú zaregistrovaní žiadni účastníci.</p>
    <?php endif; ?>

</section>

