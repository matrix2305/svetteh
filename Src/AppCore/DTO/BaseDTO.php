<?php
namespace AppCore\DTO;

use ReflectionClass;
use ReflectionProperty;

abstract class BaseDTO
{
    public function __construct(array $parameters)
    {
        $class = new ReflectionClass(static::class);
        foreach ($class->getProperties(ReflectionProperty::IS_PUBLIC) as $reflectionProperty){
            $property =  $reflectionProperty->getName();
            $this->{$property} =  $parameters[$property];
        }
    }
}