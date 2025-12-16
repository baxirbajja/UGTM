<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

$post = \App\Models\Post::all()->filter(fn($p) => is_array($p->image) && count($p->image) > 1)->first();

if ($post) {
    echo "SLUG:" . $post->slug;
} else {
    echo "NONE";
}
