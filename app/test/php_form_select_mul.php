<?php
//检查是否通过 POST 方法提交了名为 "q" 的表单数据
$q = isset($_POST["q"]) ? $_POST["q"] : "";

if(is_array($q)){
    $sites = array(
        'RUNOOB' => '菜鸟教程: http://www.runoob.com',
        'GOOGLE' => 'Google 搜索: http://www.google.com',
        'TAOBAO' => '淘宝: http://www.taobao.com',
    );
    foreach($q as $val) {
        //遍历数组   PHP_EOL 为常量，用于换行
        echo $sites[$val] . PHP_EOL;
    }
}else{
?>
<form action="" method="post">
<!--    multiple="multiple"多选，select name="q[]" 以数组的方式获取-->
    <select multiple="multiple" name="q[]">
        <option value="">选择一个站点:</option>
        <option value="RUNOOB">Runoob</option>
        <option value="GOOGLE">Google</option>
        <option value="TAOBAO">Taobao</option>
    </select>
    <input type="submit" value="提交">
</form>
<?php
}
?>
