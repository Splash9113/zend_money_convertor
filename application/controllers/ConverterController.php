<?php

class ConverterController extends Zend_Controller_Action
{

    protected $currencyService;

    public function init()
    {
        $this->currencyService = new Application_Service_Currency();
        $this->_helper->viewRenderer->setNoRender(true);
    }

    public function convertAction()
    {
        $value = $this->getRequest()->getPost('value', null);
        $from = $this->getRequest()->getPost('from', null);
        $to = $this->getRequest()->getPost('to', null);

        $response = $this->getResponse();
        $response->setHeader('Content-type', 'application/json');

        if (!$value || !$from || !$to) {
            $response->setBody(json_encode(['error' => 'Invalid request data']));
            return;
        }

        $result = $this->currencyService->calculate($value, $from, $to);

        if (!$result) {
            $response->setBody(json_encode(['error' => 'Calculation error']));
            return;
        }

        $response->setBody($result);
    }


}

