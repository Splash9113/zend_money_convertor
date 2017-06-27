<?php

class ConverterController extends Zend_Controller_Action
{

    protected $currencyService;
    protected $form;

    public function init()
    {
        $this->form = new Application_Form_Currency();
        $this->currencyService = new Application_Service_Currency();
        $this->_helper->viewRenderer->setNoRender(true);
    }

    public function convertAction()
    {
        $response = $this->getResponse();
        $response->setHeader('Content-type', 'application/json');

        if (!$this->form->isValid($this->getRequest()->getPost())) {
            $response->setBody(json_encode(['error' => 'Invalid request data']));
            return;
        }

        $value = $this->getRequest()->getPost('value', null);
        $from = $this->getRequest()->getPost('from', null);
        $to = $this->getRequest()->getPost('to', null);

        $result = $this->currencyService->calculate($value, $from, $to);

        if (!$result) {
            $response->setBody(json_encode(['error' => 'Calculation error']));
            return;
        }

        $response->setBody($result);
    }


}

