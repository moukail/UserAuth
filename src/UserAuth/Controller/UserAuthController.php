<?php
/**
 * This controller control the user login, authenticate and logout
 * @author Gihan Dilanka <mrgihandilanka@gmail.com>
 */

namespace UserAuth\Controller;
 
use Zend\Mvc\Controller\AbstractActionController;
use UserAuth\Form\LoginForm;
use UserAuth\Form\LoginFormValidation;
 
class UserAuthController extends AbstractActionController
{
    protected $form;
    protected $storage;
    protected $authservice;
     
    public function getAuthService() {
		if (!$this->authservice) {
			$this->authservice = $this->getServiceLocator()
				->get('AuthService');
		}

		return $this->authservice;
	}

	public function getSessionStorage() {
		if (!$this->storage) {
			$this->storage = $this->getServiceLocator()
				->get('UserAuth\Model\MyAuthStorage');
		}

		return $this->storage;
	}

	public function getForm() {
		if (!$this->form) {
			$request = $this->getRequest();
			$this->form = new LoginForm();
			$this->form->get('submit')->setValue(_('Login'));
			$formValidator = new LoginFormValidation();

			$this->form->setInputFilter($formValidator->getInputFilter());
			$this->form->setData($request->getPost());
		}

		return $this->form;
	}

	public function loginAction() {
		//if already login, redirect to success page 
		if ($this->getAuthService()->hasIdentity()) {
			return $this->plugin('redirect')->toUrl('/userauths/success/index');
		}

		$form = $this->getForm();

		return array(
			'form' => $form,
			'messages' => $this->flashmessenger()->getMessages()
		);
	}

	public function authenticateAction() {
		$form = $this->getForm();
		$redirect = '/userauth/login';

		$request = $this->getRequest();
		if ($request->isPost()) {
			$form->setData($request->getPost());
			if ($form->isValid() == true) {
				//check authentication...
				$this->getAuthService()->getAdapter()
					->setIdentity($request->getPost('email'))
					->setCredential($request->getPost('password'));

				$result = $this->getAuthService()->authenticate();
				foreach ($result->getMessages() as $message) {
					//save message temporary into flashmessenger
					$this->flashmessenger()->addMessage($message);
				}

				if ($result->isValid()) {
					$redirect = '/userauths/success/index';
					//check if it has rememberMe :
					if ($request->getPost('remember') == 1) {
						$this->getSessionStorage()
							->setRememberMe(1);
						//set storage again 
						$this->getAuthService()->setStorage($this->getSessionStorage());
					}
					$this->getAuthService()->getStorage()->write($request->getPost('email'));
				}
			}
		}

		return $this->plugin('redirect')->toUrl($redirect);
	}

	public function logoutAction() {
		if ($this->getAuthService()->hasIdentity()) {
			$this->getSessionStorage()->forgetMe();
			$this->getAuthService()->clearIdentity();
			$this->flashmessenger()->addMessage("You've been logged out");
		}
		return $this->plugin('redirect')->toUrl('/userauth/login');
	}

}
?>
