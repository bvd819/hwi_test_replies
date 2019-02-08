<?php 

class AccountController extends Controller
{

    public function __construct()
    {
        require(ROOT . 'models/AccountModel.php');
    }

    // For demo purposes, running the login function fetches my user and logs in as me.
    public function login($userid)
    {
        if ( isset($userid) && $userid == '' ) {
            $data['title'] = 'Helaas...';
            $data['message'] = 'Je hebt geen credentials aangeleverd.';
            $this->set($data);
            $this->render('afterlogin');
            exit();
        }
        
        if ( isset($_SESSION['account']) && $_SESSION['account']['loggedIn'] === true ) {
            $data['title'] = 'Helaas...';
            $data['message'] = 'Je bent al ingelogd als ' . $_SESSION['account']['name'] . '. Om in te kunnen loggen als iemand anders moet je eerst uitloggen.';
            $this->set($data);
            $this->render('afterlogin');
            exit();
        }

        $account = new AccountModel();
        $data = [];

        if ( $account->login($userid) === true ) {
            $data['title'] = 'Login succesvol';
            $data['message'] = 'Je bent nu ingelogd als ' . $account->name;

            //Store account object in session with logged in state.
            $returnArray = [];
            $returnArray['id'] = $account->id;
            $returnArray['name'] = $account->name;
            $returnArray['profileImage'] = $account->profileImage;
            $returnArray['loggedIn'] = true;

            $_SESSION['account'] = $returnArray;
        } else {
            $data['title'] = 'Helaas...';
            $data['message'] = 'Login niet gelukt, de opgegeven gebruiker bestaat niet in de database of er is iets misgegaan tijdens het verwerken van de login.';
        }
        
        $this->set($data);
        $this->render('afterlogin');
    }

    public function logout()
    {
        session_destroy();
        header("Location: /");
        exit();
    }

}

?>