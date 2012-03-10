<?php

/**
 * @method PHPParser_Builder_Class class(string $name) Create a class builder
 */
class PHPParser_BuilderFactory
{
    /*
     * "class" is a reserved keyword, so we implement the method as _class()
     * and redirect class() to it through __call magic
     */
    protected function _class($name) {
        return new PHPParser_Builder_Class($name);
    }

    public function __call($name, array $args) {
        if ('class' === $name) {
            return call_user_func_array(array($this, '_class'), $args);
        }

        throw new LogicException(sprintf('Method "%s" does not exist', $name));
    }
}