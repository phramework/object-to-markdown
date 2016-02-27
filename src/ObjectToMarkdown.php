<?php
/**
 * Copyright 2015-2016 Spafaridis Xenofon
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Phramework\ObjectToMarkdown;

/**
 * @license https://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 * @author Xenofon Spafaridis <nohponex@gmail.com>
 * @since 0.0.0
 */
class ObjectToMarkdown
{
    /**
     * @param mixed $value
     * @param int $level
     * @return string
     * @example ```php
     * ObjectToMarkdown::convert(4);
     * ```
     * @example ```php
     * ObjectToMarkdown::convert(['My string', 4]);
     * ```
     * @example ```php
     * ObjectToMarkdown::convert((object) [
     *     'weight' => 70.5,
     *     'height' => 179
     * ]);
     * ```
     */
    public static function convert($value, $level = 0) {
        $type = gettype($value);

        if ($type == 'array') {
            $containsScalar = array_reduce(
                $value,
                function ($carry, $v) {
                    if (is_object($v)){
                        return false;
                    }
                    return $carry;
                },
                true
            );

            if ($containsScalar) {
                return implode(
                    ', ',
                    array_map(function ($v) {
                        return static::convert($v);
                    }, $value)
                );
            }

            $return = [];

            $spaces = str_repeat(' ', 2*$level);

            foreach ($value as $v) {
                $return[] = sprintf(
                    '%s* %s',
                    $spaces,
                    self::convert($v, $level+1)
                );
            }

            return implode(','. PHP_EOL, $return);
        }

        if ($type == 'object') {
            $spaces = str_repeat(' ', 2*$level);

            $return = (
                $level === 0
                ? []
                : []
            );

            foreach ($value as $k => $v) {
                $return[] = sprintf(
                    '%s* **%s**: %s',
                    $spaces,
                    $k,
                    self::convert($v, $level+1)
                );
            }

            return PHP_EOL . implode(PHP_EOL, $return);
        }

        return (string) $value;
    }
}
