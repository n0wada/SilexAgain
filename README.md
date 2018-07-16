# SilexAgain
Silexは2018年の6月で残念ながらEOLとなってしまいました。
    
Silexの簡単にサービスプロバイダやイベントを作成できるところが好きだったので、
使用感を再現するtraitを作ってみました。

## Requirements
`PHP 5.4`以上で動作します。  

## License
MITライセンスとします。

## Installation
src以下のファイルをプロジェクトに追加するか、  
Composerに以下の記述を追加してください。

```
composer require n0wada/silexagain
```

## Usage
webアプリケーションSilexAgainTraitをクラスに適用することで使用します。
Slimを使う場合は以下のような感じです。   
beforeやafterメソッドは名前が衝突しないように自分で定義してください。
  
SilexのServiceProviderは使えません。プロバイダーにpimpleを渡す必要があり、  
Silexをそのまま使えばいいじゃん、となってしまうからです。
    
SilexAgain\ServiceProviderInterfaceまたはSilexAgain\BootableProviderInterfaceを  
implementsしたクラスを作成するようにしてください。

```php
<?php
use SilexAgain\SilexAgainTrait;
use SilexAgain\SilexAgainEvents;
use Slim\App;
  
class myApp extends App
{
    use SilexAgainTrait;
    
    function before($callback)
    {
        $this->on(SilexAgainEvents::BEFORE_EVENT, $callback);
    }
}
 
 
$app = new myApp();
    
$app->register(new YourServiceProvider());
    
$$app->before(function () {
     echo "before_event!";
});
    
$app->get("/", function () use ($app) {
    $app->dispatch(SilexAgainEvents::BEFORE_EVENT);
});
    
$app->boot()->run();
```


  
        
        
        


