<?php
/**
 * Created by PhpStorm.
 * User: x
 * Date: 2018/12/9
 * Time: 11:10 PM
 */

namespace Tests\Feature;


use Huid\Application\Application;
use Huid\Application\Plugins\HelloWorld;
use Tests\TestCaseBase;

class InstanceTest extends TestCaseBase
{

    public function testInstance()
    {

        $application = new Application();
//        $application->bind('hello', function () {
//           return 'hello world';
//        });

        echo $application->use(HelloWorld::class)
            ->hello();

    }

}