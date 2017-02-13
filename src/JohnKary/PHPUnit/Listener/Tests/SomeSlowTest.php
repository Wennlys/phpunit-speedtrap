<?php

namespace JohnKary\PHPUnit\Listener\Tests;

use PHPUnit\Framework\TestCase;

class SomeSlowTest extends TestCase
{
    public function testFastTest()
    {
        $this->assertTrue(true);
    }

    public function testSlowTests()
    {
        $this->extendTime(300);

        $this->assertTrue(true);
    }

    public function testAnotherSlowTests()
    {
        $this->extendTime(500);

        $this->assertTrue(true);
    }

    public function testLongEndToEndTest()
    {
        $this->extendTime(500);

        $this->assertTrue(true);
    }

    /**
     * @dataProvider provideTime
     */
    public function testWithDataProvider($time)
    {
        $this->extendTime($time);

        $this->assertTrue(true);
    }
    public function provideTime()
    {
        return array(
            'Rock' => array(800),
            'Chalk' => array(700),
            'Jayhawk' => array(600),
        );
    }

    /**
     * This test's runtime would normally be under the suite's threshold, but
     * this annotation sets a lower threshold, causing it to be considered slow
     * and reported on in the test output.
     *
     * @slowThreshold 5
     */
    public function testCanSetLowerSlowThreshold()
    {
        $this->extendTime(10);
        $this->assertTrue(true);
    }

    /**
     * This test's runtime would normally be over the suite's threshold, but
     * this annotation sets a higher threshold, causing it to be not be
     * considered slow and not reported on in the test output.
     *
     * @slowThreshold 50000
     */
    public function testCanSetHigherSlowThreshold()
    {
        $this->extendTime(600);
        $this->assertTrue(true);
    }

    /**
     * @param int $ms Number of additional microseconds to execute code
     */
    private function extendTime($ms)
    {
        usleep($ms * 1000);
    }
}
