<?php

namespace Sheppers\RestDocBundle\Formatter;

use Sheppers\RestDocBundle\Formatter\FormatterInterface;

class JsonFormatter implements FormatterInterface
{
    /**
     * Formats a JSON string.
     *
     * Note: Taken from Dave Perrett's blog @ http://www.daveperrett.com/articles/2008/03/11/format-json-with-php/
     *
     * @param string $input
     *
     * @return string
     */
    public function format($input)
    {
        $result = '';
        $pos = 0;
        $strLen = strlen($input);
        $indentStr = '  ';
        $newLine = "\n";
        $prevChar = '';
        $outOfQuotes = true;

        for ($i = 0; $i <= $strLen; $i++) {
            $char = substr($input, $i, 1);
            if ($char == '"' && $prevChar != '\\') {
                $outOfQuotes = !$outOfQuotes;
            } else if (($char == '}' || $char == ']') && $outOfQuotes) {
                $result .= $newLine;
                $pos--;
                for ($j = 0; $j < $pos; $j++) {
                    $result .= $indentStr;
                }
            }

            $result .= $char;

            if (($char == ',' || $char == '{' || $char == '[') && $outOfQuotes) {
                $result .= $newLine;
                if ($char == '{' || $char == '[') {
                    $pos++;
                }

                for ($j = 0; $j < $pos; $j++) {
                    $result .= $indentStr;
                }
            }

            $prevChar = $char;
        }

        return $result;
    }
}
