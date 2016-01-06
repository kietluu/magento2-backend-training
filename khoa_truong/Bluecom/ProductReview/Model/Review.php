<?php

namespace Bluecom\ProductReview\Model;

use Zend\Validator\Regex as Regex;

class Review extends \Magento\Review\Model\Review
{

    /**
     * Validate nickname of customer
     * @return array|bool|\string[]
     */
    public function validate()
    {
        $errors = [];

        //Can use pattern = '/^[a-zA-Z0-9]*-[-a-zA-Z0-9]*$/'
        $validator = new Regex(array('pattern' => '/^[a-zA-Z0-9]*[^_]*$/'));

        if($validator->isValid($this->getNickname())) {
            $errors[] = __('Nickname should not contain dashes');
        }
        if(!empty($errors)) {
            return $errors;
        }
        return parent::validate();
    }
}