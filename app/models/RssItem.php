<?

use \Phalcon\Mvc\Model;

class RssItem extends Model{
	const TBL_NAME = 'rss_item';
	
	const COL_USER_ID = 'user_id';
	const COL_ID = 'id';
	const COL_URL = 'url';
	
	private $id;
	private $user_id;
	private $url;

	public function initialize(){
		$this->setSource(self::TBL_NAME);
		$this->belongsTo(self::COL_USER_ID, "User", User::COL_ID);
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
	public function getUrl()
	{
		return $this->url;
	}

	/**
	 * @param String $url
	 */
	public function setUrl($url)
	{
		if(strpos('http', $url) === false){
			$url = 'http://' . $url;
		}
		$this->url = $url;
	}

	/**
	 * @return Integer
	 */
	public function getUserId()
	{
		return $this->user_id;
	}

	/**
	 * @param Integer $user_id
	 */
	public function setUserId($user_id)
	{
		$this->user_id = $user_id;
	}
}