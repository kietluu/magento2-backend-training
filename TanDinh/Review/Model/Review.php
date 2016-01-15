<?php
namespace TanDinh\Review\Model;

class Review extends \Magento\Review\Model\Review
{

    /**
     * Validate review summary fields
     *
     * @return bool|string[]
     */
    public function validate()
    {
        if (preg_match('/-/',$this->getNickname())) {
            $errors[] = __('Nickname is not correct.');
            return $errors;
        }

        return parent::validate();
    }
}