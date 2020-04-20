
<? 
    include_once "Twig/Autoloader.php";
    include_once "config.php";
    Twig_Autoloader::register();
    try {
        
        
        $id = $_GET['id'];
        $sql = "update shop set views=views+1 where id=$id" ;
        //UPDATE `table_name` SET `field` = `field` + 1
        if(mysqli_query($connect,$sql)){
            //echo "Успех";
        }else{
            //echo "error";
        }
       $link = $_GET['href'];
        // указывае где хранятся шаблоны
        $loader = new Twig_Loader_Filesystem('templates');
        
        // инициализируем Twig
        $twig = new Twig_Environment($loader);
        // подгружаем шаблон
        $basic = $twig->loadTemplate('element.tmpl');
        // передаём в шаблон переменные и значения
        // выводим сформированное содержание
        
        $content = $basic->render(array(
            'link'=>$link
        ));
        echo $content;
        
        
      } catch (Exception $e) {
        die ('ERROR: ' . $e->getMessage());
      }
?>