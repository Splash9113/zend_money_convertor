<?php

class Application_Form_Currency extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');

        $this->addElement('text', 'from', array(
            'label'      => 'From currency',
            'required'   => true,
            'filters'    => array('StringTrim'),
            'validators' => array(
                'NotEmpty', 'float'
            )
        ));

        $this->addElement('text', 'to', array(
            'label'      => 'To currency:',
            'required'   => true,
            'filters'    => array('StringTrim'),
            'validators' => array(
                'NotEmpty', 'float'
            )
        ));
    }


}

