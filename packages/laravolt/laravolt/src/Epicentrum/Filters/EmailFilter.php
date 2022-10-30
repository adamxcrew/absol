<?php

namespace Laravolt\Epicentrum\Filters;

use Laravolt\Ui\Filters\TextFilter;

class EmailFilter extends TextFilter
{
    protected string $label = 'Email';

    public function apply($data, $value)
    {
        if ($value) {
            $data->where('email', $value);
        }

        return $data;
    }
}
