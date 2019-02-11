<?php

declare(strict_types=1);

namespace pxgamer\Arionum\Entity;

abstract class AbstractEntity
{
    /** @param \stdClass|array|null $parameters */
    public function __construct($parameters = null)
    {
        if (!$parameters) {
            return;
        }

        if ($parameters instanceof \stdClass) {
            $parameters = get_object_vars($parameters);
        }

        $this->build($parameters);
    }

    public function build(array $parameters): void
    {
        foreach ($parameters as $property => $value) {
            $property = static::convertToCamelCase($property);

            if (property_exists($this, $property)) {
                $this->$property = $value;
            }
        }
    }

    public function toArray(): array
    {
        $settings = [];
        $called = static::class;
        $reflection = new \ReflectionClass($called);
        $properties = $reflection->getProperties(\ReflectionProperty::IS_PUBLIC);

        foreach ($properties as $property) {
            $prop = $property->getName();
            if (isset($this->$prop) && $property->class === $called) {
                $settings[self::convertToSnakeCase($prop)] = $this->$prop;
            }
        }

        return $settings;
    }

    protected static function convertDateTime(string $date): string
    {
        $dateTime = new \DateTime($date);
        $dateTime->setTimezone(new \DateTimeZone(date_default_timezone_get()));

        return $dateTime->format(\DateTime::ATOM);
    }

    protected static function convertToCamelCase($str): string
    {
        $callback = function ($match) {
            return strtoupper($match[2]);
        };

        return lcfirst(preg_replace_callback('/(^|_)([a-z])/', $callback, $str));
    }

    protected static function convertToSnakeCase($str): string
    {
        return strtolower(implode('_', preg_split('/(?=[A-Z])/', $str)));
    }
}
