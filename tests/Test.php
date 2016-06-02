<?php
namespace CodeSnippet\Tests;

use CodeSnippet\Snippet;

class Test extends \PHPUnit_Framework_TestCase
{
    protected $snippet;

    public function setUp()
    {
        $this->snippet = new Snippet();
    }

    /**
     * @expectedException CodeSnippet\Exceptions\NotFoundException
     */
    public function testFileNotExists()
    {
        return $this
            ->snippet
            ->file('notFound.ext')
            ->toArray();
    }

    public function testCountLinesWithDefaultOptions()
    {
        $snippet = $this
            ->snippet
            ->file(__DIR__ . '/fixtures/test_code.go')
            ->toArray();

        $this->assertCount(1, $snippet);
    }

    public function testContentWithDefaultOptions()
    {
        $snippet = $this
            ->snippet
            ->file(__DIR__ . '/fixtures/test_code.go')
            ->toString(null, true);

        $expected = 'func Validate(r io.Reader) {';

        $this->assertSame($expected, $snippet);
    }

    public function testGetFourLineOfTestCode()
    {
        $snippet = $this
            ->snippet
            ->file(__DIR__ . '/fixtures/test_code.go')
            ->start(4)
            ->toString(null, true);

        $expected = 'for ; i < 1<<20 && o < 1<<20; i++ { // test 1mb';

        $this->assertSame($expected, $snippet);
    }

    public function testGetThreeLinesStartingAtFour()
    {
        $snippet = $this
            ->snippet
            ->file(__DIR__ . '/fixtures/test_code.go')
            ->start(4)
            ->length(3)
            ->toString(null, true);

        $expected = 'for ; i < 1<<20 && o < 1<<20; i++ { // test 1mbn, err := r.Read(b)for i, v := range b[:n] {';

        $this->assertSame($expected, $snippet);
    }

    public function testGetThreeLinesStartingAtFourWithNewLines()
    {
        $snippet = $this
            ->snippet
            ->file(__DIR__ . '/fixtures/test_code.go')
            ->start(4)
            ->length(3)
            ->toString("\n", true);

        $expected = <<<CODE
for ; i < 1<<20 && o < 1<<20; i++ { // test 1mb
n, err := r.Read(b)
for i, v := range b[:n] {
CODE;

        $this->assertSame($expected, $snippet);
    }

    public function testGetThreeLinesStartingAtFourWithNewLinesAndNoTrim()
    {
        $snippet = $this
            ->snippet
            ->file(__DIR__ . '/fixtures/test_code.go')
            ->start(4)
            ->length(3)
            ->toString(null);

        $expected = <<<CODE
    for ; i < 1<<20 && o < 1<<20; i++ { // test 1mb
        n, err := r.Read(b)
        for i, v := range b[:n] {

CODE;

        $this->assertSame($expected, $snippet);
    }

    public function testGetFilename()
    {
        $snippet = $this
            ->snippet
            ->file(__DIR__ . '/fixtures/test_code.go')
            ->toString();

        $expected = __DIR__ . '/fixtures/test_code.go';

        $this->assertSame($expected, $this->snippet->getFilename());
    }

    public function testGetStartsFrom()
    {
        $snippet = $this
            ->snippet
            ->file(__DIR__ . '/fixtures/test_code.go')
            ->start(6)
            ->toString();

        $expected = 6;

        $this->assertSame($expected, $this->snippet->startsFrom());
    }

    public function testGetLength()
    {
        $snippet = $this
            ->snippet
            ->file(__DIR__ . '/fixtures/test_code.go')
            ->length(3)
            ->toString();

        $expected = 3;

        $this->assertSame($expected, $this->snippet->getLength());
    }

    public function testLinesAsArray()
    {
        $snippet = $this
            ->snippet
            ->file(__DIR__ . '/fixtures/test_code.go')
            ->toArray(true);

        $expected = [1 => 'func Validate(r io.Reader) {'];

        $this->assertSame($expected, $snippet);
    }

    public function testLinesAsJson()
    {
        $snippet = $this
            ->snippet
            ->file(__DIR__ . '/fixtures/test_code.go')
            ->toJson(true);

        $expected = '{"1":"func Validate(r io.Reader) {"}';

        $this->assertSame($expected, $snippet);
    }

    /**
     * @expectedException CodeSnippet\Exceptions\InvalidArgumentException
     */
    public function testNotValidStartArgument()
    {
        $snippet = $this
            ->snippet
            ->file(__DIR__ . '/fixtures/test_code.go')
            ->start('foo')
            ->toJson(true);
    }

    /**
     * @expectedException CodeSnippet\Exceptions\InvalidArgumentException
     */
    public function testNotValidLengthArgument()
    {
        $snippet = $this
            ->snippet
            ->file(__DIR__ . '/fixtures/test_code.go')
            ->length('foo')
            ->toJson(true);
    }
}
