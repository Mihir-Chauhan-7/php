<?php
    require_once 'connect.php';
function getCategoryValue($fieldname)
{
    global $singleCategory;
        if($fieldname=='btnShow')
        {
            return isset($singleCategory[0][$fieldname]) ? $singleCategory[0][$fieldname] : "hidden";      
        }
        return isset($singleCategory[0][$fieldname]) ? $singleCategory[0][$fieldname] : "";
}
function setCategoryValue($id)
{
    global $singleCategory;
    $singleCategory=fetchData('category',"cid=$id");
    $singleCategory[0]['btnShow']="true";
}
function displayCategoryList()
{
    $categoryList=getCategories();
    echo "<table border='1'>";
    for($i=0;$i<sizeof($categoryList);$i++)
    {
        echo "<tr><td>".$categoryList[$i]['cid']."</td><td>".$categoryList[$i]['title']."</td>
    <td>".$categoryList[$i]['content']."</td><td>".$categoryList[$i]['created_at']."</td><td>
    <a href='add_category.php?id=".$categoryList[$i]['cid']."'>Edit</a>
    </td><td><a href='manage_category.php?action=delete&id=".$categoryList[$i]['cid']."'>Delete</a></td></tr>";
    }    
    echo "</table>";
}
function addCategory($categoryData)
{
    //print_r(fetchData('category',"url='".$categoryData['url']."'")[0]['url']);
    unset($categoryData['submit']);
    print_r($categoryData);
    executeSQL(prepareData('category',$categoryData));
    header("Location:manage_category.php");
}
function getCategories()
{
    $query = "Select * From category";
    return executeSQL($query);

}
function deleteCategory($id)
{
    deleteData('category',"cid='".$id."'");
}
?>
