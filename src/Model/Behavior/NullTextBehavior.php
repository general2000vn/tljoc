<?php

namespace App\Model\Behavior;

use ArrayObject;
use Cake\Datasource\EntityInterface;
use Cake\Event\EventInterface;
use Cake\ORM\Behavior;
use Cake\ORM\Entity;
use Cake\ORM\Query;
use Cake\Utility\Text;


class NullTextBehavior extends Behavior
{
    protected $_defaultConfig = [
        'fields' => []
    ];

    public function initialize(array $config): void
    {
        // Some initialization code here
    }

    public function convertNull(EntityInterface $entity){
        $config = $this->getConfig();
        foreach ($config['fields'] as $field){
            $value = $entity->get($field);
            $value = trim($value);
            if ($value == ''){
                $value = null;
            }

            $entity->set($field, $value);
        }
        
        
    }

    
    public function afterMarshal(EventInterface $event, EntityInterface $entity, ArrayObject $options)
    {
        $this->convertNull($entity);
    }
}
