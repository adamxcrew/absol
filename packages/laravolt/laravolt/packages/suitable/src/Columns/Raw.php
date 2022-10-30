<?php

namespace Laravolt\Suitable\Columns;

class Raw extends Column implements ColumnInterface
{
    public function cell($cell, $collection, $loop)
    {
        if ($this->field instanceof \Closure) {
            return call_user_func($this->field, $cell, $collection, $loop);
        }

        return data_get($cell, $this->field);
    }
}
