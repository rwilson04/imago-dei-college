<?php

namespace Application\Form;

use Zend\Form\Form;

class MentorApplicationForm extends Form
{
	public function __construct($name = 'mentorApplicationForm')
	{
		parent::__construct($name);
		$this->add(array(
			'name'=>'name',
			'type'=>'Zend\Form\Element\Text',
			'options' => array(
				'label' => "Name",
			),
			'attributes' => array(
				'id' => 'name',
				'class'=>'required',
			),
		));

		$this->add(array(
			'name'=>'birthdate',
			'type'=>'Zend\Form\Element\Text',
			'options' => array(
				'label' => "Birthdate (mm-dd-yyyy)",
			),
			'attributes' => array(
				'id' => 'birthdate',
				'class'=>'required',
			),
		));

		$this->add(array(
			'name'=>'employer',
			'type'=>'Zend\Form\Element\Text',
			'options' => array(
				'label' => "Current Employer or Education Institution",
			),
			'attributes' => array(
				'id' => 'employer',
				'class'=>'required',
			),
		));

		$this->add(array(
			'name'=>'phone',
			'type'=>'Zend\Form\Element\Text',
			'options' => array(
				'label' => "Primary Phone Number",
			),
			'attributes' => array(
				'id' => 'phone',
				'class'=>'required',
			),
		));

		$this->add(array(
			'name'=>'email',
			'type'=>'Zend\Form\Element\Text',
			'options' => array(
				'label' => "E-mail",
			),
			'attributes' => array(
				'id' => 'email',
				'class'=>'required',
			),
		));

		$this->add(array(
			'name'=>'address',
			'type'=>'Zend\Form\Element\Textarea',
			'options' => array(
				'label' => "Mailing Address",
			),
			'attributes' => array(
				'id' => 'address',
				'rows' => '3',
				'class'=>'required',
			),
		));

		$this->add(array(
			'name'=>'maritalStatus',
			'type'=>'Zend\Form\Element\Select',
			'options' => array(
				'label' => "Marital Status",
			),
			'attributes' => array(
				'id' => 'maritalStatus',
				'class'=>'required',
				'options'=>array(
					'Single',
					'Married',
					'Engaged',
					'Separated',
					'Divorced',
					'Remarried',
					'Widowed',
				),
			),
		));

		$this->add(array(
			'name'=>'healthConditions',
			'type'=>'Zend\Form\Element\Radio',
			'options' => array(
				'label' => "Do you have any health conditions that might affect your capacity to serve as a mentor?",
				'value_options' => array(
					'Yes',
					'No',
				),
			),
			'attributes' => array(
				'id' => 'healthConditions',
				'class'=>'required',
			),
		));

		$this->add(array(
			'name'=>'submit',
			'type'=>'Zend\Form\Element\Submit',
			'attributes' => array( 
				'id' => 'mentorApplicationSubmit',
				'value'=>'Submit',
			),
		));

		//add element class to label, if applicable
		foreach ($this->getElements() as $element)
		{
			$attr = $element->getAttributes();
			if (array_key_exists('class',$attr))
			{
				$element->setLabelAttributes(array('class'=>$attr['class']));
			}
		}

	}

	public function clear()
	{
		foreach ($this->getElements() as $element)
		{
			$attr = $element->getAttributes();
			if ($attr['type'] !== 'button' && $attr['type'] !== 'submit')
			{
				$element->setValue("");
			}
		}
	}
}

