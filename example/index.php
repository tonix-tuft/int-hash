<?php

require_once __DIR__ . '/../vendor/autoload.php';

use IntHash\Hasher;

$hasher = new Hasher();

echo PHP_EOL;
echo json_encode(['bool (true)' => $hasher->hash(true)], JSON_PRETTY_PRINT);
echo PHP_EOL;

echo PHP_EOL;
echo json_encode(['bool (false)' => $hasher->hash(false)], JSON_PRETTY_PRINT);
echo PHP_EOL;

echo PHP_EOL;
echo json_encode(['int (32441)' => $hasher->hash(32441)], JSON_PRETTY_PRINT);
echo PHP_EOL;

echo PHP_EOL;
echo json_encode(['int (-32441)' => $hasher->hash(-32441)], JSON_PRETTY_PRINT);
echo PHP_EOL;

echo PHP_EOL;
echo json_encode(
  ['int (2147483647)' => $hasher->hash(2147483647)],
  JSON_PRETTY_PRINT
);
echo PHP_EOL;

echo PHP_EOL;
echo json_encode(
  ['int (-2147483648)' => $hasher->hash(-2147483648)],
  JSON_PRETTY_PRINT
);
echo PHP_EOL;

echo PHP_EOL;
echo json_encode(
  ['int (PHP_INT_MAX)' => $hasher->hash(PHP_INT_MAX)],
  JSON_PRETTY_PRINT
);
echo PHP_EOL;

echo PHP_EOL;
echo json_encode(
  ['int (PHP_INT_MIN)' => $hasher->hash(PHP_INT_MIN)],
  JSON_PRETTY_PRINT
);
echo PHP_EOL;

echo PHP_EOL;
echo json_encode(
  ['float/double (0.5)' => $hasher->hash(0.5)],
  JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
);
echo PHP_EOL;

echo PHP_EOL;
echo json_encode(
  ['float/double (-0.5)' => $hasher->hash(-0.5)],
  JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
);
echo PHP_EOL;

echo PHP_EOL;
echo json_encode(
  ['float/double (123891.73)' => $hasher->hash(123891.73)],
  JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
);
echo PHP_EOL;

echo PHP_EOL;
echo json_encode(
  ['float/double (-123891.73)' => $hasher->hash(-123891.73)],
  JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
);
echo PHP_EOL;

echo PHP_EOL;
echo json_encode(
  ['float/double (PHP_INT_MAX + 10)' => $hasher->hash(PHP_INT_MAX + 10)],
  JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
);
echo PHP_EOL;

echo PHP_EOL;
echo json_encode(
  ['float/double (PHP_INT_MIN - 10)' => $hasher->hash(PHP_INT_MIN - 10)],
  JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
);
echo PHP_EOL;

echo PHP_EOL;
echo json_encode(['string (abc)' => $hasher->hash("abc")], JSON_PRETTY_PRINT);
echo PHP_EOL;

echo PHP_EOL;
echo json_encode(
  ['string (abcdef)' => $hasher->hash("abcdef")],
  JSON_PRETTY_PRINT
);
echo PHP_EOL;

echo PHP_EOL;
echo json_encode(
  ['string (hfudsh873hu2ifl)' => $hasher->hash("hfudsh873hu2ifl")],
  JSON_PRETTY_PRINT
);
echo PHP_EOL;

echo PHP_EOL;
echo json_encode(
  [
    'string (The quick brown fox jumps over the lazy dog)' => $hasher->hash(
      "The quick brown fox jumps over the lazy dog"
    ),
  ],
  JSON_PRETTY_PRINT
);
echo PHP_EOL;

echo PHP_EOL;
echo json_encode(
  [
    'array ([1, 2, 3])' => $hasher->hash([1, 2, 3]),
  ],
  JSON_PRETTY_PRINT
);
echo PHP_EOL;

echo PHP_EOL;
echo json_encode(
  [
    "array (['a', 'b', 'c'])" => $hasher->hash(['a', 'b', 'c']),
  ],
  JSON_PRETTY_PRINT
);
echo PHP_EOL;

echo PHP_EOL;
echo json_encode(
  [
    "array ([1, 'a', false, 5, true, [1, 2, 3, ['f', 5, []]]])" => $hasher->hash(
      [1, 'a', false, 5, true, [1, 2, 3, ['f', 5, []]]]
    ),
  ],
  JSON_PRETTY_PRINT
);
echo PHP_EOL;

echo PHP_EOL;
echo json_encode(
  [
    "array ([1, 'a', false, 5, true, [1, 2, 3, ['f', 5, [new stdClass(), new stdClass()]]], new ArrayIterator()])" => $hasher->hash(
      [
        1,
        'a',
        false,
        5,
        true,
        [1, 2, 3, ['f', 5, [new stdClass(), new stdClass()]]],
        new ArrayIterator(),
      ]
    ),
  ],
  JSON_PRETTY_PRINT
);
echo PHP_EOL;

echo PHP_EOL;
echo json_encode(
  [
    "object (new stdClass())" => $hasher->hash(new stdClass()),
  ],
  JSON_PRETTY_PRINT
);
echo PHP_EOL;

echo PHP_EOL;
echo json_encode(
  [
    "object (new ArrayIterator())" => $hasher->hash(new ArrayIterator()),
  ],
  JSON_PRETTY_PRINT
);
echo PHP_EOL;

echo PHP_EOL;
class A {
}
echo json_encode(
  [
    "object (new A())" => $hasher->hash(new A()),
  ],
  JSON_PRETTY_PRINT
);
echo PHP_EOL;

echo PHP_EOL;
$fp = fopen(__DIR__ . '/private_local_file', 'w');
echo json_encode(
  [
    "resource (fopen())" => $hasher->hash($fp),
  ],
  JSON_PRETTY_PRINT
);
echo PHP_EOL;

echo PHP_EOL;
$c = curl_init();
echo json_encode(
  [
    "resource (curl_init())" => $hasher->hash($c),
  ],
  JSON_PRETTY_PRINT
);
echo PHP_EOL;

echo PHP_EOL;
echo json_encode(
  [
    "NULL" => $hasher->hash(null),
  ],
  JSON_PRETTY_PRINT
);
echo PHP_EOL;
