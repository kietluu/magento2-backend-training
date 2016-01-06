<?php
/**
 * Created by PhpStorm.
 * User: bo
 * Date: 05/01/2016
 * Time: 10:23
 */
namespace Bluecom\Review\Model;

class Review extends \Magento\Review\Model\Review
{
	/**
	 * Validate nick should not contain dashes
	 *
	 * @return array|bool|\string[]
	 */
	public function validate()
	{
		$errors = [];

		$validator = new \Zend\Validator\Regex(array('pattern' => '/^[a-zA-Z0-9]*-[-a-zA-Z0-9]*$/'));

		if ($validator->isValid($this->getNickname())) {
			$errors[] = __('Nickname should not contain dashes');
		}

		if (!empty($errors)) {
			return $errors;
		}

		return parent::validate();
	}
}