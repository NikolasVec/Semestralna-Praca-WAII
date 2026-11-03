<?php

namespace App\Models;

use Framework\Core\Model;

class Participant extends Model
{
    protected ?int $id = null;
    protected ?string $first_name = null;
    protected ?string $last_name = null;
    protected ?string $email = null;
    protected ?string $birth_date = null;
    protected ?int $event_year_id = null;
    protected ?string $time = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getBirthDate(): ?string
    {
        return $this->birth_date;
    }

    public function getEventYearId(): ?int
    {
        return $this->event_year_id;
    }

    public function getTime(): ?string
    {
        return $this->time;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function setFirstName(?string $first_name): void
    {
        $this->first_name = $first_name;
    }

    public function setLastName(?string $last_name): void
    {
        $this->last_name = $last_name;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function setBirthDate(?string $birth_date): void
    {
        $this->birth_date = $birth_date;
    }

    public function setEventYearId(?int $event_year_id): void
    {
        $this->event_year_id = $event_year_id;
    }

    public function setTime(?string $time): void
    {
        $this->time = $time;
    }


}

