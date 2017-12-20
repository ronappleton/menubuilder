<?php

namespace RonAppleton\MenuBuilder\Menu\Filters;

use RonAppleton\MenuBuilder\Menu\Builder;
use App\User;

class BadgeItemFilter implements ItemFilterInterface
{
    private $badgeValue;

    private $conditions;

    public function transform($item, Builder $builder)
    {
        if (!isset($item['badge_model']) || !isset($item['badge_method'])) {
            return $item;
        }

        $this->badgeValue = $this->makeBadgeValue($item);
        $this->setConditions($item);
        $item['badge_class'] = $this->makeBadgeClass($item);
        $item['badge_value'] = $this->badgeValue;

        return $item;
    }

    private function makeBadgeValue($item)
    {
        $model = $item['badge_model'];
        $method = $item['badge_method'];

        if (class_exists($model)) {
            $model = new $model;
        }

        if (method_exists($model, $method)) {
            return (new $model)->$method();
        }

        return;
    }

    private function makeBadgeClass($item)
    {
        return "badge{$this->getPill($item)}{$this->getColor($item)} pull-right";
    }

    private function getPill($item)
    {
        return in_array('badge_pill', $item) ? ' badge-pill' : '';
    }

    private function getColor($item)
    {
        if(isset($item['badge_conditions']))
        {
            $conditionColor = $this->testBadgeConditions();
        }

        $badgeColor = isset($item['badge_color']) ? $item['badge_color'] : 'secondary';

        $color = isset($conditionColor) ? $conditionColor : $badgeColor;

        return empty($color) ? '' : " badge-{$color}";
    }

    private function setConditions($item)
    {
        if (isset($item['badge_conditions'])) {
            $this->conditions = $item['badge_conditions'];
        }
    }

    private function testBadgeConditions()
    {
        foreach ($this->conditions as $condition) {

            if (!is_array($condition)) {
                continue;
            }

            switch ($condition['condition']) {
                case '==':
                    $result = $this->badgeValue == $condition['value'];
                    $color = $this->conditionColor($condition, $result);
                    break;
                case '===':
                    $result = $this->badgeValue === $condition['value'];
                    $color = $this->conditionColor($condition, $result);
                    break;
                case '!=':
                    $result = $this->badgeValue != $condition['value'];
                    $color = $this->conditionColor($condition, $result);
                    break;
                case '<>':
                    $result = $this->badgeValue <> $condition['value'];
                    $color = $this->conditionColor($condition, $result);
                    break;
                case '!==':
                    $result = $this->badgeValue !== $condition['value'];
                    $color = $this->conditionColor($condition, $result);
                    break;
                case '>':
                    $result = $this->badgeValue > $condition['value'];
                    $color = $this->conditionColor($condition, $result);
                    break;
                case '<':
                    $result = $this->badgeValue < $condition['value'];
                    $color = $this->conditionColor($condition, $result);
                    break;
                case '>=':
                    $result = $this->badgeValue >= $condition['value'];
                    $color = $this->conditionColor($condition, $result);
                    break;
                case '<=':
                    $result = $this->badgeValue <= $condition['value'];
                    $color = $this->conditionColor($condition, $result);
                    break;
            }

            $result ? $lastColor = $color : null;

            if (!$result) {
                if (!empty($lastColor)) {
                    return $lastColor;
                }
            }
        }
        return $color;
    }

    private function conditionColor($condition, $result = false)
    {
        if (isset($condition['color']) && $result) {
            return $condition['color'];
        }

        return $result ? 'success' : 'danger';
    }

}