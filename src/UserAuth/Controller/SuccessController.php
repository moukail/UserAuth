<?php
/**
 * If user authentication is succeeded redirect to the success page
 * @author Gihan Dilanka <mrgihandilanka@gmail.com>
 */

namespace UserAuth\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class SuccessController extends AbstractActionController {

	public function indexAction() {
		if (!$this->getServiceLocator()
				->get('AuthService')->hasIdentity()) {
			return $this->plugin(redirect)->toRoute('userauth', array('action' => 'login'));
		}

		return new ViewModel();
	}

}

?>
