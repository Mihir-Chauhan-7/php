<?php
    require_once 'connect.php';
    global $categoryData;
function getCategoryValue($fieldname)
{
    global $categoryData;
        if($fieldname == 'btnShow')
        {
            return isset($categoryData[0][$fieldname]) 
            ? $categoryData[0][$fieldname] 
            : "hidden";      
        }
        return isset($categoryData[0][$fieldname]) 
        ? $categoryData[0][$fieldname] 
        : "";
}
function setCategoryValue($id)
{
    global $categoryData;
    $categoryData = fetchData('category',"cid=$id");
    $categoryData[0]['btnShow'] = "true";
    $categoryData[0]['btnAdd'] = "hidden";
}
function displayCategoryList()
{
    $categoryList = getCategories();
    echo "<table border='1'>";
    for($i = 0 ; $i < sizeof($categoryList) ; $i++ )
    {
        $catNames = executeSQL("Select title From Category Where cid='"
        .$categoryList[$i]['parent_id']."'");
        $cat = isset($catNames[0]['title']) ? $catNames[0]['title'] : "-";
        echo "<tr><td>".$categoryList[$i]['cid']."</td>
            <td>".$categoryList[$i]['title']."</td><td>".$cat."</td>
            <td>".$categoryList[$i]['content']."</td><td>".$categoryList[$i]['created_at'].
            "</td><td><a href='add_category.php?id=".$categoryList[$i]['cid']."'>Edit</a>
            </td><td>
            <a href='manage_category.php?action=delete&id=".$categoryList[$i]['cid']
            ."'>Delete</a></td></tr>";
    }    
    echo "</table>";
}
function addCategory($categoryData)
{

    if(!sizeof(fetchData('category',"url='".$categoryData['url']."'") ) > 0)
    {
        unset($categoryData['submit']);
        executeSQL(prepareData('category',$categoryData));
        header("Location:manage_category.php");    
    }
    else
    {
        echo "Url Already Exist ! ";
    }
    
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
function updateCategory($newData,$id)
{
    unset($newData['update']);
    print_r($newData);
    executeSQL(prepareUpdateData('category',$newData,"cid='".$id."'"));

}
?>
