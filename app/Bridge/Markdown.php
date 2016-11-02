<?php

namespace App\Bridge;

use Parsedown;
use Purifier;

class Markdown
{
    protected $markdown;

    protected $purifier;

    public function __construct()
    {
        $this->markdown = new Parsedown();
        $this->purifier = new Purifier();
    }

    public function markdownToHtml($value)
    {
        $value = $this->markdown->setBreaksEnabled(true)->text($value);
        $value = Purifier::clean($value);

        return str_replace("<pre><code>", '<pre><code class="language-php">', $value);
    }
}
