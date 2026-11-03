<?php

namespace App\Controllers;

use App\Models\Participant;
use Framework\Core\BaseController;
use Framework\Http\Request;
use Framework\Http\Responses\Response;
use App\Models\EventYear;

class ParticipantController extends BaseController
{
    public function index(Request $request): Response
    {
        $participants = Participant::getAll();

        return $this->html([
            'participants' => $participants
        ]);
    }


    public function add(Request $request): Response
    {
        return $this->html([], 'form');
    }


    public function save(Request $request): Response
    {
        if (!$request->isPost()) {
            throw new \Framework\Http\HttpException(405);
        }

        // Načítame údaje z formulára
        $firstName = trim((string)$request->post('first_name'));
        $lastName = trim((string)$request->post('last_name'));
        $email = trim((string)$request->post('email'));
        $birthDate = (string)$request->post('birth_date');
        $time = trim((string)$request->post('time'));
        if ($request->post('registration_source') === 'public') {

            // Načítame ročníky od najnovšieho
            $years = EventYear::getAll(orderBy: 'year DESC');

            if (empty($years)) {
                throw new \Framework\Http\HttpException(400);
            }

            // Zoberieme ID ročníka s najväčším rokom
            $year = $years[0]->getId();

        } else {

            // Pri správe účastníkov ponecháme výber roka
            $year = (int)$request->post('event_year_id');

        }

        // Základná kontrola povinných údajov
        if ($firstName === '' || $lastName === '' ||
            !filter_var($email, FILTER_VALIDATE_EMAIL) ||
            !\DateTimeImmutable::createFromFormat('!Y-m-d', $birthDate) ||
            $year <= 0) {
            throw new \Framework\Http\HttpException(400);
        }

        if ($time !== '' &&
            !preg_match('/^([01]\d|2[0-3]):[0-5]\d(:[0-5]\d)?$/', $time)) {
            throw new \Framework\Http\HttpException(400);
        }

        // Zistíme, či ide o úpravu alebo pridanie
        $id = (int)$request->post('id');

        if ($id > 0) {
            // Úprava existujúceho účastníka
            $participant = Participant::getOne($id);

            if ($participant === null) {
                throw new \Framework\Http\HttpException(404);
            }
        } else {
            // Pridanie nového účastníka
            $participant = new Participant();
        }

        $participant->setFirstName($firstName);
        $participant->setLastName($lastName);
        $participant->setEmail($email);
        $participant->setBirthDate($birthDate);
        $participant->setEventYearId($year);
        $participant->setTime($time === '' ? null : $time);

        $participant->save();

        if ($request->post('registration_source') === 'public') {
            return $this->redirect($this->url('home.success'));
        }

        return $this->redirect($this->url('participant.index'));
    }


    public function edit(Request $request): Response
    {
        // Získame ID účastníka z URL adresy
        $id = (int)$request->get('id');

        // Načítame účastníka z databázy pomocou ORM
        $participant = Participant::getOne($id);

        // Ak účastník neexistuje, zobrazíme chybu 404
        if ($participant === null) {
            throw new \Framework\Http\HttpException(404);
        }

        // Pošleme účastníka do formulára
        return $this->html([
            'participant' => $participant
        ], 'form');
    }


    public function delete(Request $request): Response
    {
        // Mazanie povoľujeme iba cez POST
        if (!$request->isPost()) {
            throw new \Framework\Http\HttpException(405);
        }

        // Získame ID účastníka z formulára
        $id = (int)$request->post('id');

        if ($id <= 0) {
            throw new \Framework\Http\HttpException(400);
        }

        // Načítame účastníka pomocou ORM
        $participant = Participant::getOne($id);

        // Skontrolujeme, či existuje
        if ($participant === null) {
            throw new \Framework\Http\HttpException(404);
        }

        // Odstránime účastníka z databázy
        $participant->delete();

        // Vrátime sa na zoznam účastníkov
        return $this->redirect($this->url('participant.index'));
    }



}

