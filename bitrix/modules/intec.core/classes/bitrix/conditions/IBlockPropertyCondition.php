<?php
namespace intec\core\bitrix\conditions;

use intec\core\base\Condition;
use intec\core\base\condition\ResultModifier;
use intec\core\helpers\ArrayHelper;
use intec\core\helpers\Encoding;
use intec\core\helpers\StringHelper;
use intec\core\helpers\Type;

/**
 * Класс, представляющий условие инфоблока по свойству.
 * Class IBlockPropertyCondition
 * @property string $operator Логический оператор.
 * @property integer $id Идентификатор свойства.
 * @property string $value Значение свойства.
 * @package intec\core\bitrix\conditions
 * @author apocalypsisdimon@gmail.com
 * @deprecated
 */
class IBlockPropertyCondition extends Condition
{
    /**
     * Логический оператор: равно.
     */
    const OPERATOR_EQUAL = '=';
    /**
     * Логический оператор: не равно.
     */
    const OPERATOR_NOT_EQUAL = '!';
    /**
     * Логический оператор: меньше.
     */
    const OPERATOR_LESS = '<';
    /**
     * Логический оператор: меньше или равно.
     */
    const OPERATOR_LESS_OR_EQUAL = '<=';
    /**
     * Логический оператор: больше.
     */
    const OPERATOR_MORE = '>';
    /**
     * Логический оператор: больше или равно.
     */
    const OPERATOR_MORE_OR_EQUAL = '>=';
    /**
     * Логический оператор: содержит.
     */
    const OPERATOR_CONTAIN = '*=';
    /**
     * Логический оператор: не содержит.
     */
    const OPERATOR_NOT_CONTAIN = '!*=';

    /**
     * Возвращает список логических операторов.
     * @return array
     */
    public static function getOperators()
    {
        return [
            self::OPERATOR_EQUAL,
            self::OPERATOR_NOT_EQUAL,
            self::OPERATOR_LESS,
            self::OPERATOR_LESS_OR_EQUAL,
            self::OPERATOR_MORE,
            self::OPERATOR_MORE_OR_EQUAL,
            self::OPERATOR_CONTAIN,
            self::OPERATOR_NOT_CONTAIN
        ];
    }

    /**
     * Логический оператор.
     * @var string
     */
    protected $_operator = self::OPERATOR_EQUAL;

    /**
     * Идентификатор свойства.
     * @var integer
     */
    public $id;
    /**
     * Значение свойства.
     * @var mixed
     */
    public $value;

    /**
     * Устанавливает логический оператор.
     * @param string $value
     * @return static
     */
    public function setOperator($value)
    {
        $this->_operator = ArrayHelper::fromRange(self::getOperators(), $value);

        return $this;
    }

    /**
     * Возвращает логический оператор.
     * @return string
     */
    public function getOperator()
    {
        return $this->_operator;
    }

    /**
     * @inheritdoc
     */
    public function getIsFulfilled($provider, $modifier = null)
    {
        parent::getIsFulfilled($provider, $modifier);

        $result = false;

        if (empty($this->id))
            return $result;

        $data = $provider->receive($this);

        if (!empty($data) && $data->getIsValid()) {
            $values = $data->getValue();

            if (!Type::isArray($values)) {
                switch ($this->_operator) {
                    case self::OPERATOR_EQUAL: {
                        $result = $this->value == $values;
                        break;
                    }
                    case self::OPERATOR_NOT_EQUAL: {
                        $result = $this->value != $values;
                        break;
                    }
                    case self::OPERATOR_LESS: {
                        $result = $values < $this->value;
                        break;
                    }
                    case self::OPERATOR_LESS_OR_EQUAL: {
                        $result = $values <= $this->value;
                        break;
                    }
                    case self::OPERATOR_MORE: {
                        $result = $values > $this->value;
                        break;
                    }
                    case self::OPERATOR_MORE_OR_EQUAL: {
                        $result = $values >= $this->value;
                        break;
                    }
                    case self::OPERATOR_CONTAIN: {
                        $result = StringHelper::position($this->value, $values, 0, true, false, Encoding::getDefault()) !== false;
                        break;
                    }
                    case self::OPERATOR_NOT_CONTAIN: {
                        $result = StringHelper::position($this->value, $values, 0, true, false, Encoding::getDefault()) === false;
                        break;
                    }
                    default: {
                        $data->setIsValid(false);
                    }
                }
            } else {
                switch ($this->_operator) {
                    case self::OPERATOR_EQUAL: {
                        foreach ($values as $value) {
                            $result = $this->value == $value;

                            if ($result)
                                break;
                        }

                        break;
                    }
                    case self::OPERATOR_NOT_EQUAL: {
                        $result = true;

                        foreach ($values as $value) {
                            if ($this->value == $value) {
                                $result = false;
                                break;
                            }
                        }

                        break;
                    }
                    case self::OPERATOR_CONTAIN: {
                        foreach ($values as $value) {
                            $result = StringHelper::position($this->value, $value, 0, true, false, Encoding::getDefault()) !== false;

                            if ($result)
                                break;
                        }

                        break;
                    }
                    case self::OPERATOR_NOT_CONTAIN: {
                        $result = true;

                        foreach ($values as $value) {
                            if (StringHelper::position($this->value, $value, 0, true, false, Encoding::getDefault()) !== false) {
                                $result = false;
                                break;
                            }
                        }

                        break;
                    }
                    default: {
                        $data->setIsValid(false);
                    }
                }
            }
        }

        /** @var ResultModifier $modifier */
        if (!empty($modifier))
            $result = $modifier->modify($this, $data, $result);

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function export()
    {
        $result = parent::export();
        $result['operator'] = $this->_operator;
        $result['id'] = $this->id;
        $result['value'] = $this->value;

        return $result;
    }
}