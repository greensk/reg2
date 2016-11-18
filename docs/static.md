# Создание статичной страницы

Для создания страницы вам нужно создать новый контроллер, либо добавить действие (action) в рамках существующего контроллера.

Пример простейшего контроллера:

```php
<?php
/**
 * @file frontned/controllers/SimpleController.php
 * 
 */
namespace frontend\controllers;

use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class SimpleController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
```

При этом представление может просто содержать HTML-код:
```php
<!-- frontend/views/simple/index.php -->
<div>Hello world!</div>
```

При этом будет добавлена страница, доступная по адресу `http://myfronenddomain/?r=simple/index`, которая будет выводить представление, содержащиеся в файле `frontend/views/simple/index.php`.

Обратите внимание на следующие моменты:
* имя файла контроллера соответствует имени класса за исключением расщирение — в файле `SimpleController.php` содержится класс `SimpleController`,
* представление содержится в директории, соответствующей контроллеру — для `SimpleController` представление должно находится в директории `frontend/views/simple`,
* имя представление указывается без расширения `.php` — файл называется `index.php`, при этом в коде пишем просто `$this->render('index')`,
* представление не должно содержать общих элентов страницы — тегов `html`, `body`, общей шапки сайтаб
* в начале файла указывается `namespace frontend\controllers;` для frontend-контроллеров, `namespace backend\controllers;` для backend-контроллеров.
