<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class MentorController extends AbstractActionController
{

    public function indexAction()
    {
        return new ViewModel();
    }

	public function getView()
	{
        return new ViewModel();
	}

	public function getApplicationModel()
	{
		return new \Application\Model\MentorApplication();
	}

	public function getApplicationForm()
	{
		return new \Application\Form\MentorApplicationForm();
	}

    public function applicationAction()
    {
		$form = $this->getApplicationForm();
		$model = $this->getApplicationModel();
		$view = $this->getView();
		//$form->setAttribute('action', $this->url('mentor', array('action' => 'application')));
		$form->setAttribute('action', $this->url()->fromRoute('home/default', array('controller'=>'mentors', 'action'=>'application')));
		//echo "<pre>"; print_r($this->url()->fromRoute('home/default', array('controller'=>'mentors', 'action'=>'submitted'))); echo "</pre>";
		//ready input filtering and validation messages
		$form->setInputFilter($model->getInputFilter());
		$form->prepare();
		$request = $this->getRequest();
		if ($request->isPost())
		{
			$form->bind($model);
			$form->setData($request->getPost());
			if ($form->isValid())
			{
				$email = $model->getEmail();
				$birthdate = $model->getBirthDate();
				$view->setVariables(array(
					'email'=>$email,
					'birthdate'=>$birthdate,
					'success'=>true,
				));
				$form->clear();
			}
			else
			{
				$view->setVariables(array(
					'form'=>$form
				));
			}
		}
		else
		{
			$view->setVariables(array(
				'form'=>$form
			));
		}

		return $view;
    }

	//TODO delete this and its view
	public function submittedAction()
	{
		$form = $this->getApplicationForm();
		$model = $this->getApplicationModel();
		$view = $this->getView();
		$form->setInputFilter($model->getInputFilter());
		$request = $this->getRequest();
		if ($request->isPost())
		{
			$form->bind($model);
			$form->setData($request->getPost());
			if ($form->isValid())
			{
				$email = $model->getEmail();
				$view->setVariables(array(
					'email'=>$email,
				));
				//$form->clear();
			}
			else
			{
				//TODO show form again
			return $this->redirect()->toRoute('home/default', array('controller'=>'mentors', 'action'=>'application'));
				$view->setVariables(array(
					"error"=>"Invalid data submitted"
				));
			}
		}
		else
		{
			$view->setVariables(array(
				"error"=>"No data submitted"
			));
		}
		return $view;
	}
}
