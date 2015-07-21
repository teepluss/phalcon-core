<?php
namespace Test;

/**
 * Class UnitTest
 */
class UnitTest extends \UnitTestCase 
{
    public function testExample() 
    {
        $this->assertEquals('works',
            'works',
            'This is OK'
        );

        $this->assertEquals('works',
            'works1',
            'This will fail'
        );
    }
}
