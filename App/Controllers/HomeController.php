<?php

namespace App\Controllers;

use Framework\Core\BaseController;
use Framework\Http\Request;
use Framework\Http\Responses\Response;
use App\Models\EventYear;
use App\Models\Participant;

/**
 * Class HomeController
 * Handles actions related to the home page and other public actions.
 *
 * This controller includes actions that are accessible to all users, including a default landing page and a contact
 * page. It provides a mechanism for authorizing actions based on user permissions.
 *
 * @package App\Controllers
 */
class HomeController extends BaseController
{
    /**
     * Authorizes controller actions based on the specified action name.
     *
     * In this implementation, all actions are authorized unconditionally.
     *
     * @param string $action The action name to authorize.
     * @return bool Returns true, allowing all actions.
     */
    public function authorize(Request $request, string $action): bool
    {
        return true;
    }

    /**
     * Displays the default home page.
     *
     * This action serves the main HTML view of the home page.
     *
     * @return Response The response object containing the rendered HTML for the home page.
     */
    public function index(Request $request): Response
    {
        return $this->html();
    }


    public function registration(Request $request): Response
    {
        return $this->html();
    }


    /**
     * Displays the contact page.
     *
     * This action serves the HTML view for the contact page, which is accessible to all users without any
     * authorization.
     *
     * @return Response The response object containing the rendered HTML for the contact page.
     */
    public function contact(Request $request): Response
    {
        return $this->html();
    }

    public function success(Request $request): Response
    {
        return $this->html();
    }

    public function register(Request $request): Response
    {
        if (!$request->isPost()) {
            throw new \Framework\Http\HttpException(405);
        }

        // Nacitanie udajov z registracneho formulara
        $firstName = trim((string)$request->post('first_name'));
        $lastName = trim((string)$request->post('last_name'));
        $email = trim((string)$request->post('email'));
        $birthDate = (string)$request->post('birth_date');

        // Zakladna kontrola udajov
        if ($firstName === '' || $lastName === '' ||
            !filter_var($email, FILTER_VALIDATE_EMAIL) ||
            !\DateTimeImmutable::createFromFormat('!Y-m-d', $birthDate)) {
            throw new \Framework\Http\HttpException(400);
        }

        // Ziskame najnovsi rocnik podujatia
        $years = EventYear::getAll(orderBy: 'year DESC');

        if (empty($years)) {
            throw new \Framework\Http\HttpException(400);
        }

        $yearId = $years[0]->getId();

        // Vytvorime noveho ucastnika
        $participant = new Participant();

        $participant->setFirstName($firstName);
        $participant->setLastName($lastName);
        $participant->setEmail($email);
        $participant->setBirthDate($birthDate);
        $participant->setEventYearId($yearId);
        $participant->setTime(null);

        // Ulozenie cez ORM
        $participant->save();

        // Presmerovanie na potvrdenie registracie
        return $this->redirect($this->url('home.success'));
    }

}
