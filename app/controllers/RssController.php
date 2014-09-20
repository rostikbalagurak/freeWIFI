<?
use \Phalcon\Http\Response;

class RssController extends SecureController {
	
	public function indexAction()
	{

	}


	public function createAction($user_id, $url){
		$result = ResponseMessage::OK;
		try{
			$rssItem = new RssItem();
			$rssItem->setUserId($user_id);
			$rssItem->setUrl($url);
			$rssItem->save();
			$responseData = array(
				'result' => $result,
				'rss_item_id' => $rssItem->getId(),
				'rss_item_url' => $rssItem->getUrl(),
				'rss_item_owner' => $rssItem->getUserId()
			);
			
			$this->setOkStatus();
		} catch (Exception $e){
			$this->setInternalErrorStatus();
			
			$result = ResponseMessage::UNKNOWN_ERROR;
			$responseData = array(
				'result' => $result,
			);
		}
		$this->sendResponse($responseData);
	}
}