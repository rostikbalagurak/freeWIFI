<?
use \Phalcon\Http\Response;

class WifiController extends BaseController {
	
	public function indexAction()
	{

	}


	public function createAction($data){
		$result = ResponseMessage::OK;
		try{
			$wifiSpot = new WifiSpot();
			$wifiSpot->fill($data);
			if($wifiSpot->save()){
				$responseData = array(
					'result' => $result,
					'spot_id' => $wifiSpot->getSpotId(),
				);
			} else {
				$responseData = array(
					'result' => ResponseMessage::INTERNAL_ERROR
				);
			}
			
			$this->setOkStatus();
		} catch (Exception $e){
			$this->setInternalErrorStatus();
			
			$result = ResponseMessage::INTERNAL_ERROR;
			$responseData = array(
				'result' => $result,
			);
		}
		$this->sendResponse($responseData);
	}
}