<?php

use Phalcon\Mvc\Controller;
use \Phalcon\Mvc\View;

class BaseController extends Controller
{
	public function beforeExecuteRoute() {
		$this->view->disable();
	}

	protected function sendResponse($data = array()) {
		$this->response->setContentType('application/json', 'UTF-8');
		$this->response->setJsonContent($data);
		return $this->response->send();
	}
	
	protected function setNotFoundStatus(){
		$this->response->setStatusCode(404, "Not Found");
	}
	
	protected function setInternalErrorStatus(){
		$this->response->setStatusCode(500, "Internal Error");
	}
	
	protected function setOkStatus(){
		$this->response->setStatusCode(200, 'OK');
	}
	
	protected function setBadRequestStatus(){
		$this->response->setStatusCode(400, 'Bad Request');
	}
}
