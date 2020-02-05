<?php
    require_once 'connect.php';
    global $categoryData;
function getCategoryValue($fieldname){
    global $categoryData;
    if($fieldname == 'btnShow'){
        return isset($categoryData[$fieldname]) 
        ? $categoryData[$fieldname] 
        : "hidden";      
    }
    return isset($categoryData[$fieldname]) 
    ? $categoryData[$fieldname] 
    : "";
}
function setCategoryValue($id){
    global $categoryData;
    $categoryData = fetchData('category',"cid=$id")[0];
    $categoryData['btnShow'] = "true";
    $categoryData['btnAdd'] = "hidden";
}
function displayCategoryList(){
    $categoryList = getCategories();
    echo "<table class='table' style='text-align:center;margin:60px;width: 90%'>
        <thead class='table-success'><th>ID</th><th>Image</th>
        <th>Title</th><th>Parent Category</th><th>Publish Date</th><th colspan=2>Actions</th>
        </thead>";
    for($i = 0 ; $i < sizeof($categoryList) ; $i++ ){
        
        $image = !empty($categoryList[$i]['image']) 
            ? "<img class='img-fluid img-thumbnail' 
            style='width: 180px; height: 110px' src='".$categoryList[$i]['image']."' />"  
            : "No Image";
        
        $catNames = executeSQL("Select title From Category Where cid='"
            .$categoryList[$i]['parent_id']."'");
        
        $catTitle = isset($catNames[0]['title']) ? $catNames[0]['title'] : "-";
        echo "<tr><td>".$categoryList[$i]['cid']."</td><td>".$image."</td>
            <td>".$categoryList[$i]['title']."</td><td>".$catTitle."</td>
            <td>".$categoryList[$i]['created_at']."</td><td>
            <a href='add_category.php?id=".$categoryList[$i]['cid']."'>Edit</a></td><td>
            <a href='manage_category.php?action=delete&id=".$categoryList[$i]['cid']
            ."'>Delete</a></td></tr>";
    }    
    echo "</table>";
}
function addCategory($categoryData,$file){
    if(checkExist('category',"url='".$categoryData['url']."'")){
        echo "Url Already Exist ! ";
    }
    else{
        unset($categoryData['submit']);
        !empty($file['image']['name']) ? $categoryData['image'] = saveImage($file) : "";
        print_r($categoryData);
        executeSQL(prepareData('category',$categoryData));
        header("Location:manage_category.php");
    }
    
}
function getCategories(){
    $query = "Select * From category";
    return executeSQL($query);
}
function deleteCategory($id){
    deleteData('category',"cid='".$id."'");
}
function updateCategory($newData,$id,$file){
    !empty($file['image']['name']) ? $newData['image'] = saveImage($file) : ""; 
    unset($newData['update']);
    executeSQL(prepareUpdateData('category',$newData,"cid='".$id."'"));
    header("Location:manage_category.php");
}
?>