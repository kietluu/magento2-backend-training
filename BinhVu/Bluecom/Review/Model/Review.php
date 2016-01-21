<?php

namespace Bluecom\Review\Model;

class Review extends \Magento\Review\Model\Review
{
    /**
     * Validate review summary fields
     *
     * @return array|bool|\string[]
     */
    public function validate()
    {
        $errors = [];

        if (\Zend_Validate::is($this->getNickname(), 'Regex', array('pattern' => '/-/'))) {
            $errors[] = __('Nickname should not contain dashes');
        }

        if (!empty($errors)) {
            return $errors;
        }

        return parent::validate();
    }
}