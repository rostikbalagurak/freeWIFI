<?php
use \Phalcon\Http\Response;
class UserController extends SecureController
{

	public function indexAction()
	{
		
	}
	
	public function getAction($email, $password){
		$app = $this->getDI()->get('app');
		$salt = $app->auth->salt;
		$user = User::get($email, md5($password . $salt));
		
		if($user){
			$responseData = array(
				'result' => ResponseMessage::OK,
				'user_id' => $user->getId(),
				'firstname' => $user->getFirstname(),
				'lastname' => $user->getLastname(),
				'email' => $user->getLastname(),
			);
			
			$this->setOkStatus();
		} else {
			$this->setNotFoundStatus();
			$responseData = array(
				'result' => ResponseMessage::NOT_FOUND,
			);
		}
		$this->sendResponse($responseData);
	}
	
	public function createAction($email, $password, $firstname = "", $lastname = ""){
		if(User::exist($email)){
			$this->setBadRequestStatus();
			$responseData = array(
				'result' => ResponseMessage::USER_EXIST,
			);
		} else {
			try{
				$user = new User();
				$user->setEmail($email);
				$user->setPassword($password, true);
				$user->setFirstname($firstname);
				$user->setLastname($lastname);
				$user->save();
				
				$responseData = array(
					'result' => ResponseMessage::OK,
					'user_id' => $user->getId(),
					'firstname' => $user->getFirstname(),
					'lastname' => $user->getLastname(),
					'email' => $user->getLastname(),
				);
				$this->setOkStatus();
			} catch(Exception $e){
				$responseData = array(
					'result' => ResponseMessage::UNKNOWN_ERROR,
				);
				$this->setInternalErrorStatus();
			}
		}
		
		$this->sendResponse($responseData);
	}

}

