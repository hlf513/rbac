#PHP-RBAC v2.0 develop 修正版

使用方法见:[http://phprbac.net](http://phprbac.net)

##修改的地方
1. 规范了注释
2. 修改了bug
    * base.php中的delete()方法: 
        > $this->left => $this->Left
    * rbac.php中\BascRbac的descendants()方法:
        > //$out [$v['Title']] = $v;    
         $out [] = $v;
3. 增加了数据库配置的参数化
    > $rbac = new \PhpRbac\Rbac($db->pdo,'phprbac_');
    
    参数有三种
    * string : 'unit_test'
    * array : db配置数组
    * object : PDO | mysqli
4. 其他
    * 未定义变量的初始化
    
## 安装
> composer require hlf513/phprbac


