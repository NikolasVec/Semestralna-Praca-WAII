<?php

namespace App\Controllers;

use App\Models\EventYear;
use App\Models\Participant;
use Framework\Core\BaseController;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

class EventYearController extends BaseController
{
    public function authorize(Request $request, string $action): bool
    {
        return $this->user->isLoggedIn()
            && in_array($action, [
                'index',
                'detail',
                'add',
                'edit',
                'save',
                'delete'
            ], true);
    }
    public function index(Request $request): Response
    {
        // Načítame všetky ročníky z databázy
        $years = EventYear::getAll(orderBy: 'year DESC');

        // Pošleme ich do pohľadu
        return $this->html([
            'years' => $years
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

        // Získame rok z formulára
        $year = (int)$request->post('year');
        $id = (int)$request->post('id');

        // Kontrola správnosti roka
        if ($year < 2000 || $year > 2100) {
            throw new \Framework\Http\HttpException(400);
        }

        // Skontrolujeme, či nový rok už existuje
        if ($year !== $id && EventYear::getOne($year) !== null) {
            throw new \Framework\Http\HttpException(400);
        }

        if ($id > 0) {
            // UPDATE - načítame existujúci ročník
            $eventYear = EventYear::getOne($id);

            if ($eventYear === null) {
                throw new \Framework\Http\HttpException(404);
            }
        } else {
            // CREATE - vytvoríme nový ročník
            $eventYear = new EventYear();
        }

        // ID musí byť rovnaké ako rok konania
        $eventYear->setId($year);
        $eventYear->setYear($year);

        // Uloženie pomocou ORM
        $eventYear->save();

        return $this->redirect($this->url('eventYear.index'));
    }



    public function edit(Request $request): Response
    {
        // Získame ID ročníka z URL
        $id = (int)$request->get('id');

        // Načítame ročník pomocou ORM
        $eventYear = EventYear::getOne($id);

        if ($eventYear === null) {
            throw new \Framework\Http\HttpException(404);
        }

        // Zobrazíme formulár
        return $this->html([
            'eventYear' => $eventYear
        ], 'form');
    }


    public function delete(Request $request): Response
    {
        if (!$request->isPost()) {
            throw new \Framework\Http\HttpException(405);
        }

        // Získame ID ročníka
        $id = (int)$request->post('id');

        // Načítame ročník cez ORM
        $eventYear = EventYear::getOne($id);

        if ($eventYear === null) {
            throw new \Framework\Http\HttpException(404);
        }

        // Ročník s účastníkmi nemožno vymazať
        if ($eventYear->getPocetUcastnikov() > 0) {
            throw new \Framework\Http\HttpException(400);
        }

        // Vymazanie pomocou ORM
        $eventYear->delete();

        return $this->redirect($this->url('eventYear.index'));
    }


    public function detail(Request $request): Response
    {
        // Získame ID ročníka z URL
        $id = (int)$request->get('id');

        // Načítame ročník pomocou ORM
        $eventYear = EventYear::getOne($id);

        if ($eventYear === null) {
            throw new \Framework\Http\HttpException(404);
        }

        // Načítame všetkých účastníkov daného ročníka
        $participants = $eventYear->getAllRelated(
            Participant::class,
            'event_year_id'
        );

        return $this->html([
            'eventYear' => $eventYear,
            'participants' => $participants
        ]);
    }



}

