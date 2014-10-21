<?php
use \Phalcon\Http\Response;

class WifiController extends BaseController {
	
	public function indexAction()
	{

	}


	public function createAction(){
		$responseData = array();
		if(!$this->request->isPost()){
			$this->setBadRequestStatus();
		} else {
			$this->setOkStatus();
			try{
				$wifiSpot = new WifiSpot();
				$wifiSpot->setOwnerId($this->request->getPost(WifiSpot::COL_OWNER_ID));
				$wifiSpot->setPassword($this->request->getPost(WifiSpot::COL_PASSWORD), null, '');
				$wifiSpot->setName($this->request->getPost(WifiSpot::COL_NAME));
				$wifiSpot->setAddress($this->request->getPost(WifiSpot::COL_ADDRESS));
				$wifiSpot->setPopularity($this->request->getPost(WifiSpot::COL_POPULARITY));
				$wifiSpot->setLat($this->request->getPost(WifiSpot::COL_LAT));
				$wifiSpot->setLng($this->request->getPost(WifiSpot::COL_LNG));
				
				$wifiSpot->save();
				$responseData = array(
					'result' => ResponseMessage::OK,
					'spot' => $wifiSpot->asArray(),
				);
			} catch(Exception $e){
				$this->handleError($e->getMessage());
				return;
			}
		}

		$this->sendResponse($responseData);
	}
	
	public function getSingleAction($spot_id){
		$wifiSpot = WifiSpot::findFirst($spot_id);
		if(!empty($wifiSpot)){
			$wifiSpot = $wifiSpot->asArray();
		}
		
		$responseData = array(
			'wifi_spot' => $wifiSpot
		);
		$this->setOkStatus();
		$this->sendResponse($responseData);
	}

	/**
	 * @param $filters
	 * Param should assoc array in json format
	 */
	public function getAction($filters){
		$filters = json_decode($filters, true);
		$owner_id = isset($filters[WifiSpot::COL_OWNER_ID]) ? $filters[WifiSpot::COL_OWNER_ID] : null;
		
		$owner = User::findFirst($owner_id);
		$res = $owner->WifiSpot->toArray();

		$responseData = array(
			'wifi_spots' => $res
		);
		$this->setOkStatus();
		$this->sendResponse($responseData);
	}
	
	
}