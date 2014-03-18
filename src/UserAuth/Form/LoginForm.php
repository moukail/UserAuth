<?php 
namespace UserAuth\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Zend\InputFilter;

class LoginForm extends Form {

	public function __construct() {
		
		parent::__construct('user_login');
		$this->setAttribute('method','post');
		$this->setAttribute('class','form-horizontal');
		$this->setAttribute('enctype','multipart/form-data');
		
		$this->add(array(
			'name' => 'id',
			'attributes' => array(
				'type' => 'hidden'
			)
		));
		
		$this->add(array(
			'name' => 'first_name',
			'type' => 'text',
			'attributes' => array(
				'class' => 'form-control',
				'id' => 'first_name',
				'placeholder' => 'First Name',
				
			)
		));
		
		$this->add(array(
			'name' => 'last_name',
			'type' => 'text',
			'attributes' => array(
				'class' => 'form-control',
				'id' => 'last_name',
				'placeholder' => 'Last Name'
			)
		));
		
		$this->add(array(
			'name' => 'office_name',
			'type' => 'text',
			'attributes' => array(
				'class' => 'form-control',
				'id' => 'office_name',
				'placeholder' => 'Office Name'
			)
		));
		
		$this->add(array(
			'name' => 'email',
			'type' => 'text',
			'attributes' => array(
				'class' => 'form-control',
				'id' => 'email',
				'placeholder' => 'Email'
			)
		));
		
		$this->add(array(
			'name' => 'password',
			'type' => 'password',
			'attributes' => array(
				'class' => 'form-control',
				'id' => 'password',
				'placeholder' => 'Password'
			)
		));
		
		$this->add(array(
			'name' => 're_password',
			'type' => 'password',
			'attributes' => array(
				'class' => 'form-control',
				'id' => 're_password',
				'placeholder' => 'Re-Enter Password'
			)
		));
		
		$this->add(array(
			'name' => 'remember',
			'type' => 'checkbox',
			'attributes' => array(
				'id' => 'remember'
			)
		));
		
		 $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'id' => 'submit',
                'class'=>'btn btn-primary',
            ),
        ));
	}
	

}
?>