<?php

namespace App\Models;

use Framework\Core\Model;

class EventYear extends Model
{
    protected static ?string $tableName = 'event_years';

    protected ?int $id = null;
    protected ?int $year = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }
}

