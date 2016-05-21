<?php
namespace YAUS\Tests;

require 'vendor/autoload.php';


/**
 * This is the URL CRUD test.
 * We'll add, remove and edit links.
 * Class UrlCrudTest
 * @package YAUS\Tests
 */
class UrlCrudTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {

    }

    /**
     * @dataProvider urlsProvider
     */
    public function testInsertUrl($url)
    {
        $this->assertTrue(true);
    }



    public function urlsProvider()
    {
        return [
            ["https://www.test1.com"],
            ["https://www.test2.com"],
            ["https://www.test3.com"],
            ["https://www.test4.com"],
            ["https://www.test5.com"]
        ];
    }
}
