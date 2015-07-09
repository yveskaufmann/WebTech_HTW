<?php

namespace Splendr\App\Model;

use Doctrine\Common\Annotations\AnnotationRegistry;
use Propel\Runtime\Connection\ConnectionInterface;
use Splendr\App\Model\Base\User as BaseUser;
use Splendr\App\Model\Map\UserTableMap;
use Splendr\Core\Helper\Login;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * The User class representing a user account in the splendr
 * application. This class is responsible for saving, updating and
 * validate the account data.
 *
 */
class User extends BaseUser {

    /**
     * The confirmation password which is used to check
     * if the password was correctly entered by the user.
     *
     * @var string
     * @Assert\NotBlank(message="Please confirm your password by entering the password again in the password confirmation field.")
     */
    private $confirmPassword;

    /**
     * Setter for the confirm password.
     *
     * @param $password_confirm
     */
    public function setConfirmPassword($password_confirm) {

        $this->confirmPassword = (string) $password_confirm;
    }

    /**
     * Encrypt the password before saving the new created user.
     *
     * @param ConnectionInterface $con
     * @return bool
     */
    public function preSave(ConnectionInterface $con = null) {
        if ($this->isNew() || $this->isColumnModified(UserTableMap::COL_PASSWORD)) {
            $password = Login::encryptPassword($this->getPassword());
            $this->setPassword($password);
        }
        return parent::preSave($con);
    }

    public function validate(ValidatorInterface $validator = null) {

        if (is_null($validator)) {
            /**
             * The underlying annotation parser don't use autoload so we have to enabled it manual.
             */
            AnnotationRegistry::registerLoader('class_exists');
            $validator = Validation::createValidatorBuilder()
                ->enableAnnotationMapping()
                ->getValidator();

            parent::validate();
            $failures = $validator->validate($this);
            if ( is_null($this->validationFailures)) {
                $this->validationFailures = $failures;
            } else {
                $this->validationFailures->addAll($failures);
            }
        }

        return count($this->validationFailures) === 0;
    }

    /**
     * Checks if the password was correctly entered again in the confirmation field.
     *
     * @Assert\IsTrue(message = "The entered confirmation password don't match your entered password")
     */
    public function isPasswordConfirmationMatchPassword() {
        return is_string($this->confirmPassword) &&  $this->confirmPassword === (string)$this->getPassword();
    }
}
