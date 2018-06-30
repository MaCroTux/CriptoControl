<?php

namespace CriptoControl\Tests\Integration\Infrastructure\UserInterface;

use Symfony\Component\Console\Output\Output;

class OutputSpy extends Output
{
    private $data;

    public function writeln($messages, $options = 0)
    {
        $this->data = $messages;

        parent::writeln($messages, $options);
    }

    public function data(): string
    {
        return $this->data;
    }

    protected function doWrite($message, $newline)
    {
        // TODO: Implement doWrite() method.
    }
}
