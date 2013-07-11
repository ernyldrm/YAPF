<?php
namespace Application\Controller;

use YAPF\Core\Database;
use YAPF\Core\Route;
use YAPF\Core\View;
use YAPF\Library\Http;

class Home
{
    public function index($id = 0, $name = '')
    {
        return new View('layout', array(
            'slave' => array(
                'id' => $id,
                'name' => $name
            )
        ));
    }

    public function redirect()
    {
        Http::redirect('http://google.com');
    }

    public function error()
    {
        Http::sendStatus(404);
    }

    public function route()
    {
        return new Route('Admin@Home:index');
    }

    public function model($key = 'v')
    {
        /** Add
        $new = new Test(array('key' => 'foo', 'value' => 'bar'));
        Database::Test()->add($new); */

        /** Delete
        $model = Database::Test()->find(3);
        Database::Test()->delete($model); */

        /** Select ALL
        $list = Database::Test()->get();
        var_dump($list); */

        /** Select WHERE
        $list = Database::Test()->where('id < ?', 3)
        ->get(); */

        /** Select WHERE
        $list = Database::Test()->where('`id` < ? AND `value` = ?', 3, 'hyp')
        ->get(); */

        /** Update
        $model = Database::Test()->find(2);
        $model->value = 'Bar';
        Database::Test()->update($model); */
    }
}