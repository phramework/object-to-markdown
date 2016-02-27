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
 * @coversDefaultClass ObjectToMarkdown
 * @license https://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 * @author Xenofon Spafaridis <nohponex@gmail.com>
 * @since 0.0.0
 */
class ObjectToMarkdownTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ::convert
     */
    public function testConvertString()
    {
        $markdown = ObjectToMarkdown::convert('my string');

        $this->assertSame('my string', $markdown);
    }

    /**
     * @covers ::convert
     */
    public function testConvertFloat()
    {
        $markdown = ObjectToMarkdown::convert(5.3);

        $this->assertSame('5.3', $markdown);
    }

    /**
     * @covers ::convert
     */
    public function testConvertInteger()
    {
        $markdown = ObjectToMarkdown::convert(4);

        $this->assertSame('4', $markdown);
    }

    /**
     * @covers ::convert
     */
    public function testConvertArray()
    {
        $markdown = ObjectToMarkdown::convert(['my string', 4]);

        $this->assertSame('my string, 4', $markdown);
    }

    /**
     * @covers ::convert
     */
    public function testConvertArrayNested()
    {
        $array = [
            'my string',
            4,
            ['member', 'regular'],
            (object) [
                'street' => 'My Street',
                'number' => 6,
                'postal' => 60100
            ],
            (object) [
                'street' => 'Another street',
                'number' => 56,
                'postal' => 40100
            ]
        ];
        $markdown = ObjectToMarkdown::convert($array);

        $this->markTestIncomplete();
    }

    /**
     * @covers ::convert
     */
    public function testConvertObject()
    {
        $object = (object) [
            'weight' => 70.4,
            'height' => 179
        ];

        $markdown = ObjectToMarkdown::convert($object);

        $this->markTestIncomplete();
    }

    /**
     * @covers ::convert
     */
    public function testConvertObjectNested()
    {
        $object = (object) [
            'weight' => 70.4,
            'height' => 179,
            'address' => (object) [
                'street' => 'My Street',
                'number' => 6,
                'postal' => 60100
            ],
            'tags' => ['member', 'regular']
        ];

        $markdown = ObjectToMarkdown::convert($object);

        $this->markTestIncomplete();
    }
}
