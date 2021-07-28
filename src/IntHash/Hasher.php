<?php

/*
 * Copyright (c) 2021 Anton Bagdatyev (Tonix)
 *
 * Permission is hereby granted, free of charge, to any person
 * obtaining a copy of this software and associated documentation
 * files (the "Software"), to deal in the Software without
 * restriction, including without limitation the rights to use,
 * copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following
 * conditions:
 *
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
 * OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
 * HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
 * WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
 * OTHER DEALINGS IN THE SOFTWARE.
 */

namespace IntHash;

use DeclarativeFactory\DeclarativeFactory;
use Fun\Fun;
use IntHash\HasherInterface;
use IntHash\Specialized\ArrayHasher;
use IntHash\Specialized\BoolHasher;
use IntHash\Specialized\FloatHasher;
use IntHash\Specialized\IntHasher;
use IntHash\Specialized\NullHasher;
use IntHash\Specialized\ObjectHasher;
use IntHash\Specialized\ResourceHasher;
use IntHash\Specialized\StringHasher;

/**
 * A facade-like class representing a hasher for data.
 *
 * @author Anton Bagdatyev (Tonix) <antonytuft@gmail.com>
 */
class Hasher implements HasherInterface {
  /**
   * {@inheritdoc}
   */
  public function hash($data, $options = []) {
    /**
     * Variables can store data of different types, and different data types can do different things.
     *
     * PHP supports the following data types:
     *
     *     1) Boolean (bool)
     *     2) Integer (int)
     *     3) Float (floating point numbers - also called double) (float/double)
     *     4) String (string)
     *     5) Array (array)
     *     6) Object (object)
     *     7) callable - This case is handled with strings, objects and arrays (see https://www.php.net/manual/en/language.types.callable.php).
     *     8) iterable - Either an array or an object implementing the Traversable interface.
     *                   No need to implement a hasher for this pseudo-type as this case is already handled for o objects and arrays.
     *     9) Resource (resource)
     *     10) NULL
     *
     */

    /**
     * @var HasherInterface $specializedHasher
     */
    $specializedHasher = DeclarativeFactory::factory([
      [is_bool($data), Fun::fnReturnNew(BoolHasher::class)],
      [is_int($data), Fun::fnReturnNew(IntHasher::class)],
      [is_float($data), Fun::fnReturnNew(FloatHasher::class)],
      [is_string($data), Fun::fnReturnNew(StringHasher::class)],
      [is_array($data), Fun::fnReturnNew(ArrayHasher::class)],
      [is_object($data), Fun::fnReturnNew(ObjectHasher::class)],
      [is_resource($data), Fun::fnReturnNew(ResourceHasher::class)],
      [is_null($data), Fun::fnReturnNew(NullHasher::class)],
      function () use (&$data) {
        $message = sprintf(
          'Cannot compute hash for data type "%1$s".',
          gettype($data)
        );
        throw new \Exception($message);
      },
    ]);
    $hash = $specializedHasher->hash($data, $options);
    return $hash;
  }
}
