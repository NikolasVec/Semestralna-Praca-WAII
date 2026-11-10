<?php

namespace App\Models;

use Framework\Core\Model;

class EventYear extends Model
{
    protected static ?string $tableName = 'event_years';

    protected ?int $id = null;
    protected ?int $year = null;
    protected ?int $pocet_ucastnikov = 0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function getPocetUcastnikov(): ?int
    {
        return $this->pocet_ucastnikov;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setYear(int $year): void
    {
        $this->year = $year;
    }
}

