<?php

trait Copyable
{
    // 誤った推測をするので無視する
    /** @phpstan-ignore-next-line */
    function copy(...$params): static
    {
        $prev = $this->copyDefalutValues();
        $new = array_intersect_key($params, $prev);

        return new static(...[...$prev, ...$new]);
    }

    /**
     * @return array<string, mixed>
     */
    function copyDefalutValues()
    {
        $rf = new \ReflectionClass(self::class);
        $names = array_map(fn ($v) => $v->name, $rf->getConstructor()?->getParameters() ?? []);
        $filter = array_fill_keys($names, 0);
        $defValues = (array)$this;
        return array_intersect_key($defValues, $filter);
    }
}
