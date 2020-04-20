<? 
    include_once "Twig/Autoloader.php";
    include_once "config.php";
    Twig_Autoloader::register();
    try {
        
       
        $sql = "select * from shop order by views DESC";
        $res = mysqli_query($connect, $sql);
        $dataGalary = [];
        while($data = mysqli_fetch_assoc($res)){
            
            array_push($dataGalary, $data);
        }
        //print_r($dataGalary);

        // указывае где хранятся шаблоны
        $loader = new Twig_Loader_Filesystem('templates');
        
        // инициализируем Twig
        $twig = new Twig_Environment($loader);
        // подгружаем шаблон
        $basic = $twig->loadTemplate('basic.tmpl');
        // передаём в шаблон переменные и значения
        // выводим сформированное содержание
        
        $content = $basic->render(array(
            'name' => 'Clark Kent',
            'username' => 'ckent',
            'password' => 'krypt0n1te',
            'dataGalary' => $dataGalary
        ));
        echo $content;
        
        
      } catch (Exception $e) {
        die ('ERROR: ' . $e->getMessage());
      }
?>