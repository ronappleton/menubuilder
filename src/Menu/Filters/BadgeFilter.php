<?php

namespace RonAppleton\MenuBuilder\Menu\Filters;

use RonAppleton\MenuBuilder\Menu\Builder;
use App\User;

class BadgeFilter implements FilterInterface
{
    private $badgeValue;

    private $conditions;

    public function transform($item, Builder $builder)
    {
        if (!isset($item['header']) && isset($item['badge_model']) && isset($item['badge_method'])) {
            $this->badgeValue = $this->makeBadgeValue($item);
            $this->setConditions($item);
            $item['badge_class'] = $this->makeBadgeClass($item);
            $item['badge_value'] = $this->badgeValue;
        }

        return $item;
    }

    private function makeBadgeValue($item)
    {
        $model = $item['badge_model'];

        $method = $item['badge_method'];

        return (new $model)->$method();
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
        $conditionColor = $this->testBadgeConditions();

        $badgeColor = isset($item['badge_color']) ? $item['badge_color'] : null;

        $color = empty($conditionColor) ?  empty($badgeColor) ? null : $badgeColor : $conditionColor;

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
        if (empty($this->conditions)) {
            return null;
        }

        $result = false;

        foreach ($this->conditions as $condition) {

            switch ($condition['condition']) {
                case '==':
                    $result = $this->badgeValue == $condition['value'];
                    break;
                case '===':
                    $result = $this->badgeValue === $condition['value'];
                    break;
                case '!=':
                    $result = $this->badgeValue != $condition['value'];
                    break;
                case '<>':
                    $result = $this->badgeValue <> $condition['value'];
                    break;
                case '!==':
                    $result = $this->badgeValue !== $condition['value'];
                    break;
                case '>':
                    $result = $this->badgeValue > $condition['value'];
                    break;
                case '<':
                    $result = $this->badgeValue < $condition['value'];
                    break;
                case '>=':
                    $result = $this->badgeValue >= $condition['value'];
                    break;
                case '<=':
                    $result = $this->badgeValue <= $condition['value'];
                    break;
            }
            if (!$this->continueOn($condition) || !$result) {
                return $this->conditionColor($condition, $result);
            }
        }
        return $this->conditionColor(null, $result);
    }

    private function continueOn($condition)
    {
        if (isset($condition['continue']) && $condition['continue']) {
            return true;
        }
        return false;
    }

    private function conditionColor($condition, $result = false)
    {
        if (!empty($condition)) {
            if (isset($condition['color']) && $result) {
                return $condition['color'];
            }
        }

        $result = $result ? 'true' : 'false';

        return isset($this->conditions[$result . '_color']) ? $this->conditions[$result . '_color'] : null;
    }

}