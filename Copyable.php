<?php

trait Copyable
{
    function copy(...$params)
    {
        $prev = $this->copyDefalutValues();
        $new = array_intersect_key($params, $prev);

        return new static(...[...$prev, ...$new]);
    }

    function copyDefalutValues(): array
    {
        $rf = new ReflectionClass(self::class);
        $filter = array_fill_keys(array_map(fn ($v) => $v->name, $rf->getConstructor()->getParameters()), 0);
        $defValues = (array)$this;
        return array_intersect_key($defValues, $filter);
    }
}
