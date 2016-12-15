<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/15
 * Time: 13:30
 */

namespace core;


use Exception;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;

abstract  class myValidation extends myMiddleware
{

    protected $validatorMapper = [
        'email' => Email::class,
        'required' => PresenceOf::class,
    ];

    public function isValid($object): bool
    {
        if ($this->request->isPost()) {
            $data = $this->request->getPost();
//            dd($data);
            $validation = $this->getValidator();
            $messages = $validation->validate($data);
            if (count($messages)) {
                foreach ($messages as $message) {
                    $this->flash->error($message);
                }
                $this->redirectBack();
                return false;
            }
        }
        return true;
    }

    protected function getValidator()
    {
        $validation = new \Phalcon\Validation();
        foreach ($this->rules as $field => $validationExpression) {
            foreach ($this->getValidatorClass($validationExpression) as $validatorClass) {
                $validation->add($field, new $validatorClass);
            }
        }
        return $validation;
    }

    protected function getValidatorClass($validationExpression)
    {
        $results = preg_split('!\s*\|\s*!', $validationExpression);
        foreach ($results as $key => $value) {
            $value = trim($value);
            if(!$value) throw new Exception('please check your rule definition:'.$validationExpression);
            if (!isset($this->validatorMapper[$value])) throw new Exception("validator:{$value} is not defined!");
            $results[$key] = $this->validatorMapper[$value];
        }
        return $results;
    }
}