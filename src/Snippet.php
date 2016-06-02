<?php
namespace CodeSnippet;

use CodeSnippet\Exceptions\NotFoundException;
use CodeSnippet\Exceptions\InvalidArgumentException;
use SplFileObject;

class Snippet
{
    /**
     * @var string
     */
    protected $file = null;

    /**
     * @var integer
     */
    protected $start = 1;

    /**
     * @var integer
     */
    protected $length = 1;

    /**
     * Set filename
     *
     * @param string $filename
     * @throws \Exception
     * @return CodeSnippet\Snippet
     */
    public function file($filename)
    {
        $this->file = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @throws CodeSnippet\Exceptions\NotFoundException
     * @return string
     */
    public function getFilename()
    {
        if (file_exists($this->file) === false) {
            throw new NotFoundException('File "' . $this->file . '" not found');
        }

        return $this->file;    
    }

    /**
     * Set start line
     *
     * @param integer $start
     * @throws CodeSnippet\Exceptions\InvalidArgumentException
     * @return CodeSnippet\Snippet
     */
    public function start($start)
    {
        if (is_integer($start) === false) {
            throw new InvalidArgumentException();
        }

        $this->start = abs($start);

        return $this;
    }

    /**
     * Get start line
     *
     * @return integer
     */
    public function startsFrom()
    {
        return (int) $this->start;
    }

    /**
     * Set length
     *
     * @param integer $length
     * @throws CodeSnippet\Exceptions\InvalidArgumentException
     * @return CodeSnippet\Snippet
     */
    public function length($length)
    {
        if (is_integer($length) === false) {
            throw new InvalidArgumentException();
        }

        $this->length = abs($length);

        return $this;
    }

    /**
     * Get length
     *
     * @return integer
     */
    public function getLength()
    {
        return (int) $this->length;
    }

    /**
     * Return lines as array
     *
     * @param bool $trim
     * @return array
     */
    public function toArray($trim = false)
    {
        return $this->getSnippet($trim);
    }

    /**
     * Return lines as json
     *
     * @param bool $trim
     * @return string
     */
    public function toJson($trim = false)
    {
        return json_encode($this->toArray($trim));
    }

    /**
     * Return lines as string
     *
     * @param string $new_line
     * @param bool $trim
     * @return string
     */
    public function toString($new_line = "\n", $trim = false)
    {
        return implode($new_line, $this->toArray($trim));
    }

    /**
     * Get sliced and trimmed file array
     *
     * @param bool $trim
     * @return array
     */
    protected function getSnippet($trim)
    {
        $sliced_array = array_slice($this->getFileArray(), $this->start, $this->length, true);

        if ($trim === true) {
            return array_map('trim', $sliced_array);
        }
        
        return $sliced_array;        
    }

    /**
     * Get raw file array
     *
     * @return array
     */
    protected function getFileArray()
    {
        $file_array = iterator_to_array(new SplFileObject($this->getFilename(), 'r'));
        array_unshift($file_array, null);

        return $file_array;
    }    
}
