<? 

use Phalcon\Mvc\Model as Model;
use Phalcon\Config;

class User extends Model{
	const COL_ID = 'id';
	const COL_EMAIL = 'email';
	const COL_FIRSTNAME = 'firstname';
	const COL_lASTNAME = 'lastname';
	const COL_PASSWORD = 'password';
	
	const FB_PREFIX = 'fb_';
	
	const TBL_NAME = 'users';
	
	private $id;
	private $email;
	private $firstname;
	private $lastname;
	private $password;
	private $facebook_id;

	/**
	 * @return string
	 */
	public function getFacebookId()
	{
		return $this->facebook_id;
	}

	/**
	 * @param string $facebook_id
	 */
	public function setFacebookId($facebook_id)
	{
		if(strpos($facebook_id, self::FB_PREFIX) === false){
			$facebook_id = self::FB_PREFIX . $facebook_id;
		}
		$this->facebook_id = $facebook_id;
	}

	/**
	 * @return mixed
	 */
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * @param $password
	 * @param bool $hash
	 */
	public function setPassword($password, $hash = false)
	{
		if($hash){
			$app = $this->getDI()->get('app');
			$password = md5($password . $app->auth->salt);
		}
		$this->password = $password;
	}
	
	public function initialize(){
		$this->setSource(self::TBL_NAME);
		$this->hasMany(self::COL_ID, 'RssItem', WifiSpot::COL_OWNER_ID);
	}
	
	/**
	 * @return String
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * @param String $email
	 */
	public function setEmail($email)
	{
		$this->email = $email;
	}

	/**
	 * @return String
	 */
	public function getFirstname()
	{
		return $this->firstname;
	}

	/**
	 * @param String $firstname
	 */
	public function setFirstname($firstname)
	{
		$this->firstname = $firstname;
	}

	/**
	 * @return Integer
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param Integer $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * @return String
	 */
	public function getLastname()
	{
		return $this->lastname;
	}

	/**
	 * @param String $lastname
	 */
	public function setLastname($lastname)
	{
		$this->lastname = $lastname;
	}

	/**
	 * @param $email
	 * @return bool
	 */
	public static function exist($email){
		$u = User::findFirst(array(self::COL_EMAIL . ' = "' . $email . '"'));
		return !empty($u);
	}

	/**
	 * @param array $parameters
	 * @return User
	 */
	public static function findFirst($parameters = array()){
		return parent::findFirst($parameters);
	}

	/**
	 * @param $email
	 * @param $password
	 * @return User|false
	 */
	public static function get($email, $password){
		$query = User::query()
			->where("email = :email:")
			->andWhere("password = :password:")
			->bind(array("email" => $email, "password" => $password))
			->limit(1)
			->execute();
		
			return $query->getFirst();
	}
}