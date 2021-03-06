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

/**
 * Generic interface for hashers.
 *
 * @author Anton Bagdatyev (Tonix) <antonytuft@gmail.com>
 */
interface HasherInterface {
  /**
   * Computes a 32-bit hash for the given data.
   *
   * @see https://www.php.net/manual/en/language.types.intro.php
   * @see https://stackoverflow.com/questions/113511/best-implementation-for-hashcode-method-for-a-collection#answer-113600
   *
   * @param mixed $data The data for which to compute the hash.
   * @param array $options An array of options:
   *
   *                           - 'prime' (int): A prime (an int) to use for hashing (instead of the default one
   *                                            used by the concrete hasher implementation of this interface).
   *                           - 'factor' (int): A factor (preferably a prime too) to also use for the computation of the hash (defaults to 1);
   *
   * @return int The hash, represented as a 32-bit integer.
   * @throws \Exception If the hash couldn't be computed for some reasons.
   */
  public function hash($data, $options = []);
}
