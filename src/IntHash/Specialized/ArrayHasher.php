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

namespace IntHash\Specialized;

use IntHash\HasherInterface;
use IntHash\Hasher;
use Tonix\PHPUtils\IntUtils;
use IntHash\Primes;

/**
 * A hasher for arrays.
 *
 * @author Anton Bagdatyev (Tonix) <antonytuft@gmail.com>
 */
class ArrayHasher implements HasherInterface {
  /**
   * {@inheritdoc}
   */
  public function hash($data) {
    $hash = 1;
    $hasher = new Hasher();
    foreach ($data as $key => $value) {
      $keyPartialHash = $hasher->hash($key);
      $partialHash = $hasher->hash($value);

      $hash = IntUtils::intOverflow32Bit(
        Primes::PRIME_37 * $hash + $keyPartialHash
      );
      $hash = IntUtils::intOverflow32Bit(
        Primes::PRIME_37 * $hash + $partialHash
      );
    }
    return $hash;
  }
}
