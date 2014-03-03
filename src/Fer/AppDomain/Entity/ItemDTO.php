<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 03/03/14
 * Time: 15:44
 */

namespace Fer\AppDomain\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as JMS;

class ItemDTO {

    /**
     * @JMS\Type("integer")
     */
    public $id;

    /**
     * @JMS\Type("string")
     */
    public $name;

    /**
     * @JMS\Type("string")
     */
    public $description;
} 