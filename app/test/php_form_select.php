<?php

//php表单-下拉菜单单选
//htmlspecialchars() 函数是 PHP 中用于将特殊字符转换为 HTML 实体的函数。它可以帮助防止跨站脚本攻击（XSS）
//预定义的 $_GET 变量用于收集来自 method="get" 的表单中的值
$q = isset($_GET['q'])? htmlspecialchars($_GET['q']) : '';

if($q) {
    if($q =='RUNOOB') {
        echo '菜鸟教程<br>http://www.runoob.com';
    } else if($q =='GOOGLE') {
        echo 'Google 搜索<br>http://www.google.com';
    } else if($q =='TAOBAO') {
        echo '淘宝<br>http://www.taobao.com';
    }
} else {
//    action 为空表示提交到当前脚本
//    使用get方法获取数据变量q中的数据
//    通过select的name属性获取下拉菜单的值
    ?><form action="" method="get">
        <select name="q">
            <option value="">选择一个站点:</option>
            <option value="RUNOOB">Runoob</option>
            <option value="GOOGLE">Google</option>
            <option value="TAOBAO">Taobao</option>
        </select>
        <input type="submit" value="提交">
    </form><?php
}
?>
