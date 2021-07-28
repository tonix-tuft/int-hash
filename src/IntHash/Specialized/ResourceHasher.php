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
use IntHash\Primes;
use IntHash\Specialized\IntHasher;
use IntHash\Specialized\StringHasher;
use Tonix\PHPUtils\IntUtils;

/**
 * A hasher for resource data.
 *
 * @author Anton Bagdatyev (Tonix) <antonytuft@gmail.com>
 */
class ResourceHasher implements HasherInterface {
  /**
   * {@inheritdoc}
   */
  public function hash($data, $options = []) {
    [
      'prime' => $prime,
      'factor' => $factor,
    ] = $options + [
      'prime' => Primes::PRIME_41,
      'factor' => 1,
    ];

    $hash = 1;
    $intHasher = new IntHasher();
    $stringHasher = new StringHasher();
    $resourceId = intval($data);
    $resourceType = get_resource_type($data);
    $intHash = $intHasher->hash($resourceId);
    $stringHash = $stringHasher->hash($resourceType);

    $hash = IntUtils::intOverflow32Bit($prime * $hash + $intHash);
    $hash = IntUtils::intOverflow32Bit($prime * $hash + $stringHash);
    $hash = IntUtils::intOverflow32Bit($hash * $factor);

    return $hash;
  }
}
