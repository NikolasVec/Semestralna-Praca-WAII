<?php
/** @var \Framework\Support\LinkGenerator $link */
/** @var \App\Models\EventYear[] $years */
?>

<section class="information">

    <h1>Ročníky podujatia</h1>

    <a class="participant-btn"
       href="<?= $link->url('eventYear.add') ?>">
        Pridať ročník
    </a>

    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Rok konania</th>
            <th>Počet účastníkov</th>
            <th>Akcie</th>
        </tr>

        <?php foreach ($years as $year): ?>
            <tr>
                <td><?= e($year->getId()) ?></td>
                <td><?= e($year->getYear()) ?></td>
                <td><?= e($year->getPocetUcastnikov()) ?></td>

                <td>
                    <a class="participant-btn"
                       href="<?= $link->url('eventYear.detail',
                           ['id' => $year->getId()]) ?>">
                        Zobraziť účastníkov
                    </a>
                    <a class="participant-btn"
                       href="<?= $link->url('eventYear.edit',
                           ['id' => $year->getId()]) ?>">
                        Upraviť
                    </a>

                    <form method="post"
                          action="<?= $link->url('eventYear.delete') ?>"
                          style="display: inline;"
                          onsubmit="<?php if ($year->getPocetUcastnikov() > 0): ?>
                                  alert('Na vymazanie ročníka musí byť počet účastníkov nulový.');
                                  return false;
                          <?php else: ?>
                                  return confirm('Naozaj chceš vymazať tento ročník?');
                          <?php endif; ?>">

                        <input type="hidden"
                               name="id"
                               value="<?= e($year->getId()) ?>">

                        <button type="submit" class="participant-btn">
                            Vymazať
                        </button>
                    </form>
                </td>

            </tr>
        <?php endforeach; ?>
    </table>

    <?php if (empty($years)): ?>
        <p>Zatiaľ nie sú vytvorené žiadne ročníky.</p>
    <?php endif; ?>

</section>


