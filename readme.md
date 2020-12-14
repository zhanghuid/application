### 可扩展的运行 `php` 代码容器

---

#### Feature
1. 直接 `bind` 定回调
```php 

use Huid\Application;

$application = new Application

$application->bind('hello', function () {
    return 'hello world';
});

echo $application->hello();

```

2. 直接注入 `plugin`
```php 

# 定义如下 `plugin` 文件
class Huid\Application\plugins;

class HelloWorld implements PluginContract
{

    public static function install(Application $application, ...$opt)
    {
        $application->bind('hello', function () {
            return 'hello world plugin';
        });
    }
}

# 运行
use Huid\Application;
use Huid\Application\Plugins\HelloWorldPlugin;

$application = new Application

$application->use(HelloWorldPlugin::class);
echo $application->hello();

```

### Inspire
[QueryList](https://github.com/jae-jae/QueryList)
