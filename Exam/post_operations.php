<?php
function displayPostList(){
    $postList = getPosts();
        echo "<table class='table' style='text-align:center;margin:60px;width: 90%'>
            <thead class='table-success'><th>ID</th><th>Category Name</th>
            <th>Title</th><th>Published At</th><th colspan=2>Actions</th></thead>";
    for($i = 0 ; $i < sizeof($postList) ; $i++ ){
        echo "<tr><td>".$postList[$i]['pid']."</td><td>".$postList[$i]['category']."</td>
            <td>".$postList[$i]['title']."</td><td>".$postList[$i]['published_at']."</td>
            <td><a href='add_post.php?id=".$postList[$i]['pid']."'>Edit</a>
            </td><td><a href='manage_post.php?action=delete&id=".$postList[$i]['pid']."'
            >Delete</a></td></tr>";
    }    
    echo "</table>";
}

function getPosts(){
    $query = "SELECT P.pid,P.title,P.published_at,GROUP_CONCAT(C.title) AS category
                FROM blog_post P INNER JOIN post_category PC ON P.pid = PC.pid
                INNER JOIN category C ON C.cid = PC.cid GROUP BY P.pid";
    return executeSQL($query);
}
function addPost($blogPostData){
    if(checkExist('blog_post',"url='".$blogPostData['url']."'")){
        echo "Url Already Exist";
    }
    else{
        $selectedCategory = $blogPostData['categories'];
        unset($blogPostData['submit']);
        unset($blogPostData['categories']);
        $blogPostData['uid'] = $_SESSION['uid'];
        executeSQL(prepareData('blog_post',$blogPostData));
        $last_post_id = $_SESSION['last_id'];
        addPostRelation($selectedCategory,$last_post_id);
    }  
}
function getPostValue($fieldname){
    global $singlePost;
    if($fieldname == 'btnShow'){
       return isset($singlePost[$fieldname]) ? $singlePost[$fieldname] : "hidden";      
    }        
    return isset($singlePost[$fieldname]) ? $singlePost[$fieldname] : "";
}
function setPostValue($id){
    global $singlePost;
    $query = "SELECT P.title,P.content,P.url,P.published_at,GROUP_CONCAT(C.title) 
        AS category FROM blog_post P INNER JOIN post_category PC ON P.pid = PC.pid
        INNER JOIN category C ON C.cid = PC.cid where (P.pid=$id) GROUP BY P.pid";
    
    $singlePost = executeSQL($query)[0];
    $singlePost['btnShow'] = "true";
    $singlePost['btnAdd'] = "hidden";
    $singlePost['category'] = explode(",",$singlePost['category']);
}
function deletePost($id){
    deleteData('blog_post',"pid='".$id."'");
}

function addPostRelation($selectedCategory,$last_post_id){
    foreach($selectedCategory as $singleCategory){
        $query = "Insert into post_category values(NULL,".$last_post_id.",".$singleCategory
            .")";
        executeSQL($query);
        header("Location:manage_post.php");
    }
}
function updatePost($newData,$id){
    unset($newData['cpassword']);
    unset($newData['update']);
    deleteData('post_category',"pid='".$id."'");
    $selectedCategory = $newData['categories'];
    addPostRelation($selectedCategory,$id);
    executeSQL(prepareUpdateData('blog_post',$newData,"pid='".$id."'"));
    header("Location:manage_post.php");
}
?>