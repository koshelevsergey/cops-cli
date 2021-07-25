<?php

namespace Cops\Cli;

use Symfony\Component\Console\Application as BaseApplication;

/**
 * Class Application
 *
 * @package Cops\Cli
 */
class Application extends BaseApplication
{
    /** @var string  */
    private const NAME = 'cops-cli';
    private const VERSION = '1.0.0';

    /**
     * Constructor.
     *
     * @param iterable $commands
     */
    public function __construct(iterable $commands)
    {
        parent::__construct(self::NAME, self::VERSION);

        foreach ($commands as $command) {
            $this->add($command);
        }
    }
}
