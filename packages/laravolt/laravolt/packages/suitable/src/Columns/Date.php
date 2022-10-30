<?php

namespace Laravolt\Suitable\Columns;

use Carbon\Carbon;

class Date extends Column implements ColumnInterface
{
    protected $format = 'LL';

    protected $timezone;

    public function __construct($header)
    {
        parent::__construct($header);
        $this->timezone = auth()->check() ? auth()->user()->timezone : config('app.timezone');
    }

    public function cell($cell, $collection, $loop)
    {
        $field = data_get($cell, $this->field);

        try {
            return Carbon::createFromFormat('Y-m-d', $field)
                ->locale(config('app.locale'))
                ->setTimezone($this->timezone)
                ->isoFormat($this->format);
        } catch (\InvalidArgumentException $e) {
            try {
                return Carbon::createFromFormat('Y-m-d H:i:s', $field)
                    ->locale(config('app.locale'))
                    ->setTimezone($this->timezone)
                    ->isoFormat($this->format);
            } catch (\InvalidArgumentException $e) {
                return $field;
            }
        }
    }

    public function format(string $format)
    {
        $this->format = $format;

        return $this;
    }

    public function timezone(string $timezone)
    {
        $this->timezone = $timezone;

        return $this;
    }
}
