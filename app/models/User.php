<? 

use Phalcon\Mvc\Model as Model;
use Phalcon\Config;
use Phalcon\Mvc\Model\Query\Builder;

class User extends Model{
	const COL_ID = 'id';
	const COL_EMAIL = 'email';
	const COL_FIRSTNAME = 'firstname';
	const COL_lASTNAME = 'lastname';
	const COL_PASSWORD = 'password';
	
	const TBL_NAME = 'users';
	
	private $id;
	private $email;
	private $firstname;
	private $lastname;
	private $password;

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
		$this->hasMany(self::COL_ID, 'RssItem', RssItem::COL_USER_ID);
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
		//TODO !!!!!
		$emailCondition = Utils::getQueryCondition(self::COL_EMAIL, $email, '=', true);
		$passCondition = Utils::getQueryCondition(self::COL_PASSWORD, $password , '=', true);

		$builder = new Builder();
		$res = $builder
			->columns(array(self::COL_ID))
			->from('User')
			->where($emailCondition)
			->andWhere($passCondition)
			->limit(1)
			->getQuery()
			->execute();
		
		if($res->count() > 0){
			$first = $res->getFirst();
			$id = (int)$first['id'];
			return self::find(array(Utils::getQueryCondition(self::COL_ID, $id, '=', false)));
		} else {
			return false;
		}
	}
}