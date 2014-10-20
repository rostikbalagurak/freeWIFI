<? 

use Phalcon\Mvc\Model;
use Phalcon\Config;

class User extends Model{
	const COL_ID = 'user_id';
	const COL_FACEBOOK_ID = 'facebook_id';
	const COL_EMAIL = 'email';
	const COL_FIRSTNAME = 'firstname';
	const COL_lASTNAME = 'lastname';
	const COL_PASSWORD = 'password';
	
	const FB_PREFIX = 'fb_';
	
	const TBL_NAME = 'user';
	
	private $user_id;
	private $email;
	private $firstname;
	private $lastname;
	private $password;
	private $facebook_id;

	public function initialize(){
		$this->setSource(self::TBL_NAME);
//		$this->hasMany(self::COL_ID, 'WifiSpot', WifiSpot::COL_OWNER_ID);
	}

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
	public function getUserId()
	{
		return $this->user_id;
	}

	/**
	 * @param Integer $id
	 */
	public function setUserId($id)
	{
		$this->user_id = $id;
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
	public static function findFirst($parameters = null){
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
	
	public function save($data = null, $whiteList = null){
		$this->verifyData();
		parent::save($data, $whiteList);
	}

	/**
	 * @throws Exception
	 */
	private function verifyData(){
		if(!isset($this->password) || !isset($this->email)){
			throw new Exception('Some of necessary data is missing');
		}
		
		switch(true){
			case !isset($this->password):
				throw new Exception('Password is missing');
			break;
			case !isset($this->email):
				throw new Exception('Email is missing');
			break;
		}
	}
}