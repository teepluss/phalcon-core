<?php

namespace App\Libraries\Extend\Translate\Adapter;

use Phalcon\Translate\Adapter\NativeArray as BaseNativeArray;

class NativeArray extends BaseNativeArray
{
    /**
     * Returns the translation related to the given key
     *
     * @param   string $index
     * @param   array $placeholders
     * @return  string
     */
    public function query($index, $placeholders = null)
    {
        $array = $this->_translate;

        if (is_null($index)) {
            return $this->replacePlaceholders($array, $placeholders);
        }

        if (isset($array[$index])) {
            return $this->replacePlaceholders($array[$index], $placeholders);
        }

        foreach (explode('.', $index) as $segment) {
            if (!is_array($array) || !array_key_exists($segment, $array)) {
                return $this->replacePlaceholders($index, $placeholders);
            }

            $array = $array[$segment];
        }

        return $this->replacePlaceholders($array, $placeholders);
    }

    /**
     * Check whether is defined a translation key in the internal array
     *
     * @param   string $index
     * @return  bool
     */
    public function exists($index)
    {
        $array = $this->_translate;

        if (empty($array) || is_null($index)) {
            return false;
        }

        if (array_key_exists($index, $array)) {
            return true;
        }

        foreach (explode('.', $index) as $segment) {
            if (!is_array($array) || !array_key_exists($segment, $array)) {
                return false;
            }

            $array = $array[$segment];
        }

        return true;
    }
}
