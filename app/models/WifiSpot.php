<?

use \Phalcon\Mvc\Model;

class WifiSpot extends Model
{
	const TBL_NAME = 'wifi_spot';

	const COL_SPOT_ID = 'spot_id';
	const COL_NAME = 'name';
	const COL_OWNER_ID = 'owner_id';
	const COL_PASSWORD = 'password';
	const COL_ADDRESS = 'address';
	const COL_POPULARITY = 'popularity';
	const COL_LAT = 'lat';
	const COL_LNG = 'lng';
	
	private $spot_id;
	private $owner_id;
	private $name;
	private $password;
	private $address;
	private $popularity;
	private $lat;
	private $lng;

	public function initialize()
	{
		$this->setSource(self::TBL_NAME);
//		$this->belongsTo(self::COL_OWNER_ID, "User", User::COL_ID);
	}
	
	public function fill($data){
		$className = get_class($this);
		foreach($data as $property => $value){
			if(property_exists($className, $property)){
				$this->$property = $value;
			}
		}
	}

	/**
	 * @param null $params
	 * @return WifiSpot
	 */
	public static function findFirst($params = null){
		return parent::findFirst($params);
	}
	
	public function asArray(){
		return array(
			self::COL_SPOT_ID => $this->spot_id,
			self::COL_NAME => $this->name,
			self::COL_PASSWORD => $this->password,
			self::COL_OWNER_ID => $this->owner_id,
			self::COL_POPULARITY => $this->popularity,
			self::COL_ADDRESS => $this->address,
			self::COL_LAT => $this->lat,
			self::COL_LNG => $this->lng
		);
	}

	/**
	 * @return mixed
	 */
	public function getAddress()
	{
		return $this->address;
	}

	/**
	 * @param mixed $address
	 */
	public function setAddress($address)
	{
		$this->address = $address;
	}

	/**
	 * @return mixed
	 */
	public function getSpotId()
	{
		return $this->spot_id;
	}

	/**
	 * @param mixed $id
	 */
	public function setSpotId($id)
	{
		$this->spot_id = $id;
	}

	/**
	 * @return mixed
	 */
	public function getLat()
	{
		return $this->lat;
	}

	/**
	 * @param mixed $lat
	 */
	public function setLat($lat)
	{
		$this->lat = $lat;
	}

	/**
	 * @return mixed
	 */
	public function getLng()
	{
		return $this->lng;
	}

	/**
	 * @param mixed $lng
	 */
	public function setLng($lng)
	{
		$this->lng = $lng;
	}

	/**
	 * @return mixed
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param mixed $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}

	/**
	 * @return mixed
	 */
	public function getOwnerId()
	{
		return $this->owner_id;
	}

	/**
	 * @param mixed $owner_id
	 */
	public function setOwnerId($owner_id)
	{
		$this->owner_id = $owner_id;
	}

	/**
	 * @return mixed
	 */
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * @param mixed $password
	 */
	public function setPassword($password)
	{
		$this->password = $password;
	}

	/**
	 * @return mixed
	 */
	public function getPopularity()
	{
		return $this->popularity;
	}

	/**
	 * @param mixed $popularity
	 */
	public function setPopularity($popularity)
	{
		$this->popularity = $popularity;
	}

}