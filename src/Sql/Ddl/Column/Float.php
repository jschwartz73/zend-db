<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Zend\Db\Sql\Ddl\Column;

class Float extends Column
{
    protected $specification = '%1$s DECIMAL(%2$s.%3$s)%4$s%5$s';
    protected $digits;
    protected $decimal;

    public function __construct($name, $digits, $decimal)
    {
        $this->name = $name;
        $this->digits = $digits;
        $this->decimal = $decimal;
    }

    public function getExpressionData()
    {
        $spec = $this->specification;

        $params = array();

        $types = array(self::TYPE_IDENTIFIER, self::TYPE_LITERAL, self::TYPE_LITERAL);
        $params[] = $this->name;
        $params[] = $this->digits;
        $params[] = $this->decimal;


        $types[] = self::TYPE_LITERAL;
        $params[] = (!$this->isNullable) ? ' NOT NULL' : '';

        $types[] = ($this->default !== null) ? self::TYPE_VALUE : self::TYPE_LITERAL;
        $params[] = ($this->default !== null) ? $this->default : '';

        return array(array(
            $spec,
            $params,
            $types
        ));

    }
}