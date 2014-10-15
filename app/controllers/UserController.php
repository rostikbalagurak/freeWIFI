<?php
use \Phalcon\Http\Response;
use User as Lalalala;
class UserController extends BaseController
{

	public function indexAction()
	{
		
	}

	public function getAction($email, $password){
		$app = $this->getDI()->get('app');
		$salt = $app->auth->salt;
		
		$user = Lalalala::get($email, md5($password . $salt));
		if($user){
			$responseData = array(
				'result' => ResponseMessage::OK,
				'user_id' => $user->getUserId(),
				'firstname' => $user->getFirstname(),
				'lastname' => $user->getLastname(),
				'email' => $user->getEmail(),
			);

			$this->setOkStatus();
		} else {
			$this->setNotFoundStatus();
			$responseData = array(
				'result' => ResponseMessage::USER_NOT_FOUND,
			);
		}
		$this->sendResponse($responseData);
	}
	
	public function createAction(){
		$responseData = array();
		if(!$this->request->isPost()){
			$this->setBadRequestStatus();
		} else {
			$this->setOkStatus();
			if(User::exist($this->request->getPost('email'))){
				$responseData = array(
					'result' => ResponseMessage::USER_EXIST,
				);
			} else {
				try{
					$user = new User();
					$user->setEmail($this->request->getPost('email'));
					$user->setPassword($this->request->getPost('password'), true);
					
					if($firstName = $this->request->getPost('firstname')){
						$user->setFirstname($firstName);
					}
					if($lastName = $this->request->getPost('lastname')){
						$user->setLastname($lastName);
					}
					if($fb_id = $this->request->getPost('facebook_id')){
						$user->setFacebookId($fb_id);
					}
					$user->save();

					$responseData = array(
						'result' => ResponseMessage::OK,
						'user_id' => $user->getUserId(),
					);
				} catch(Exception $e){
					$this->handleError($e->getMessage());
					return;
				}
			}
		}
		
		$this->sendResponse($responseData);
	}
	

}

