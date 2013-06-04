<?php

namespace Sheppers\RestDocBundle\Twig;

use Sheppers\RestDocBundle\Formatter\FormatterInterface;

class PrettyExtension extends \Twig_Extension
{
    /**
     * Array of formatters.
     *
     * @var array
     */
    protected $formatters = array();

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'pretty';
    }

    /**
     * {@inheritDoc}
     */
    public function getFilters()
    {
        return array(
            'pretty' => new \Twig_Filter_Method($this, 'format'),
        );
    }

    /**
     * Adds a formatter for the given format.
     *
     * @param string $format
     * @param FormatterInterface $formatter
     */
    public function addFormatter($format, FormatterInterface $formatter)
    {
        $this->formatters[$format] = $formatter;
    }

    /**
     * Determines if a formatter exists for the given format.
     *
     * @param string $format
     *
     * @return bool
     */
    public function hasFormatter($format)
    {
        return isset($this->formatters[$format]);
    }

    /**
     * Executes the formatter for the given format over the given input.
     *
     * @param string $input
     * @param string $format
     *
     * @throws \InvalidArgumentException
     *
     * @return string
     */
    public function format($input, $format)
    {
        if (false === $this->hasFormatter($format)) {
            throw new \InvalidArgumentException("No formatter found for format '{$format}'");
        }

        return $this->formatters[$format]->format($input);
    }
}
