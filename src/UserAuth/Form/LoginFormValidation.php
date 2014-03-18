<?php

/**
 * reamsoft technologies (Pvt) Ltd. (http://reamsoft.com/)
 *
 * @link      git@reamsoft.com:elearn-user.repo
 * @copyright Copyright (c) 2013 reamsoft (Pvt) Ltd
 * @license reamsoft Proprietary License
 * @author Dilanka <mrgihandilanka@gmail.com>
 */

namespace UserAuth\Form;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class LoginFormValidation implements InputFilterAwareInterface {

	protected $inputFilter;
	
	public function __construct() {
		
	}
	
	/**
	 * @author Gihan Dilanka <mrgihandilanka@gmail.com>
	 */
	public function getInputFilter() {
		if(!$this->inputFilter) {
			$inputFilter = new InputFilter();
			$factory = new InputFactory();
			
			$inputFilter->add($factory->createInput(array(
					'name' => 'email',
					'required' => true,
					'filters' => array(
						array('name' => 'StripTags'),
						array('name' => 'StringTrim'),
					),
					'validators' => array(
						array(
							'name' => 'StringLength',
							'options' => array(
								'encoding' => 'UTF-8',
								'min' => 1,
								'max' => 255,
							),
						),
					),
			)));
			
			$inputFilter->add($factory->createInput(array(
					'name' => 'password',
					'required' => true,
					'filters' => array(
						array('name' => 'StripTags'),
						array('name' => 'StringTrim'),
					),
					'validators' => array(
						array(
							'name' => 'StringLength',
							'options' => array(
								'encoding' => 'UTF-8',
								'min' => 1,
								'max' => 255,
							),
						),
					),
			)));
			$this->inputFilter = $inputFilter;
		}
		return $this->inputFilter;
	}

	/**
	 * @param object $inputFilter Zend form input elements  
	 */
	public function setInputFilter(InputFilterInterface $inputFilter) {
		throw new \Exception('Not used');
	}
	
}



