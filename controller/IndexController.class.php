<?php

class IndexController extends Controller
{
    public $view = 'index';
    public $title;
    protected $controls = [
        '' => 'Главная страница',
        '?path=catalog' => 'Каталог',
        '?path=cabinet' => 'Личный кабинет',
    ];

	
	//метод, который отправляет в представление информацию в виде переменной content_data
	function index($data){
        return ['subcategories' => $categories, 'goods' => $goods, 'controls' => $this->controls];
	}

	/*function test($id){

    }
*/

}

//site/index.php?path=index/test/5