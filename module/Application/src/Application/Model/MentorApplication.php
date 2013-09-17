<?php

namespace Application\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class MentorApplication implements InputFilterAwareInterface
{
	protected $inputFilter;
	protected $email;
	protected $birthdate;

	public function getEmail()
	{
		return $this->email;	
	}

	public function getBirthDate()
	{
		return $this->birthdate;	
	}

	public function getInputFilter()
	{
		$required = array(
			'name'=>'NotEmpty',
			'break_chain_on_failure'=>true,
			'options'=>array(
				'messages'=>array('isEmpty'=>'Required'),
			),
		);
		$filters = array(
			array('name'=>'StringTrim'),
			array('name'=>'StripTags'),
		);
		if (!$this->inputFilter)
		{
			$inputFilter = new InputFilter();
			$factory = new InputFactory();
			$inputFilter->add($factory->createInput(array(
				'name'=>'email',
				'validators'=>array(
					$required,
					array(
						'name'=>'EmailAddress',
						'options'=>array(
							'messages'=>array('emailAddressInvalidFormat'=>'Please enter a valid email address'),
						),
					),
				),
				'filters'=>$filters,

			)));
			//for all simple text fields or other elements, just add a 'required' validator 
			$names = array(
				'name',
				'employer',
				'address',
				'healthConditions',
			);
			foreach ($names as $name)
			{
				$inputFilter->add($factory->createInput(array(
					'name'=>$name,
					'validators'=>array($required),
					'filters'=>$filters,
				)));
			}

			$inputFilter->add($factory->createInput(array(
				'name'=>'birthdate',
				'validators'=>array(
					$required,
					array(
						'name'=>'Date',
						'break_chain_on_failure'=>true,
						'options'=>array(
							'format'=>'m-d-Y',
							'messages'=>array('dateFalseFormat'=>'Invalid date format, must be mm-dd-yyyy', 'dateInvalidDate'=>'Invalid date, must be mm-dd-yyyy'),
						),
					),
					array(
						'name'=>'Regex',
						'options'=>array(
							'messages'=>array('regexNotMatch'=>'Invalid date format, must be mm-dd-yyyy'),
							'pattern'=>'/^\d{1,2}-\d{1,2}-\d{4}$/',
						),
					),
				),
				'filters'=>$filters,
			)));
				

			$this->inputFilter = $inputFilter;
		}
		return $this->inputFilter;
	}

	public function setInputFilter(InputFilterInterface $filter) //required by interface
	{
		throw new \Exception("Not used");
	}

	function populate($data)
	{
		foreach ($data as $key=>$value)
		{
			if (property_exists($this, $key))
			{
				$this->$key = $value;
			}
		}
	}

	public function getArrayCopy() //alias needed for form->bind
	{
		return $this->toArray();
	}

	public function toArray()
	{
		$array = array(
			'email'=>"0".$this->getEmail(),
			'birthdate'=>"0".$this->getBirthDate(),
		);
		return $array;
	}


}
