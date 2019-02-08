<?php 

class AccountModel extends Model
{
    /**
     * Unique identifier in database, needs to be provided to __construct.
     * @var int
     */
    public $id = 0;

    /**
     * Username is populated from database.
     *
     * @var string
     */
    public $name = '';

    /**
     * Contains profile image for display in template.
     *
     * @var string
     */
    public $profileImage = '';

    /**
     * The logged in state of the account object.
     *
     * @var boolean
     */
    public $loggedIn = false;

    /**
     * Uses the provided $id for a simplified login solution. Fetches user based on provided id and returns AccountModel object with logged_in status.
     * Normally user input would have to be sanitized in order to safely fetch the matching user from the database.
     *
     * @param int $accountId
     */
    public function login($accountId)
    {
        $sql = "SELECT * FROM account WHERE id = " . $accountId;
        $statement = Database::establishConnection()->prepare($sql);
        $statement->execute();

        if ($result = $statement->fetch(PDO::FETCH_ASSOC)) {
            $this->id = $result['id'];
            $this->name = $result['name'];
            $this->profileImage = $result['image'];
            $this->loggedIn = true;

            return true;
        }

        return false;
    }

    public function logout()
    {

    }

}

?>