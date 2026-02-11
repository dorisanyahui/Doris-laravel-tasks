<?php
header('Content-Type: text/plain; charset=utf-8');

function listDir($path, $depth = 1) {
  $result = [];
  if (!is_dir($path)) return ["[not a dir] $path"];
  $items = scandir($path);
  foreach ($items as $i) {
    if ($i === "." || $i === "..") continue;
    $full = rtrim($path, "/") . "/" . $i;
    $result[] = (is_dir($full) ? "[DIR]  " : "[FILE] ") . $full;
    if ($depth > 0 && is_dir($full)) {
      $sub = scandir($full);
      foreach ($sub as $s) {
        if ($s === "." || $s === "..") continue;
        $result[] = "       " . (is_dir($full."/".$s) ? "[DIR]  " : "[FILE] ") . $full."/".$s;
      }
    }
  }
  return $result;
}

echo "PWD: " . getcwd() . PHP_EOL;
echo "PHP: " . PHP_VERSION . PHP_EOL;
echo "----" . PHP_EOL;
foreach (listDir(__DIR__, 1) as $line) echo $line . PHP_EOL;
