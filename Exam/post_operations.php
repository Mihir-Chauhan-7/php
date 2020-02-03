<?php
function displayPostList()
{
    $postList=getPosts();
    echo "<table border='1'>";
    for($i=0;$i<sizeof($postList);$i++)
    {
        echo "<tr><td>".$postList[$i]['pid']."</td><td>".$postList[$i]['title']."</td>
    <td>".$postList[$i]['published_at']."</td><td>
    <a href='add_post.php?id=".$postList[$i]['pid']."'>Edit</a>
    </td><td><a href='manage_post.php?action=delete&id=".$postList[$i]['pid']."'>Delete</a></td></tr>";
    }    
    echo "</table>";
}

function getPosts()
{
    $query = "Select * From blog_post";
    return executeSQL($query);

}
function addPost($blogPostData)
{
    $selectedCategory=$blogPostData['categories'];
    unset($blogPostData['submit']);
    unset($blogPostData['categories']);
    $blogPostData['uid']=$_SESSION['uid'];
    print_r($blogPostData);
    executeSQL(prepareData('blog_post',$blogPostData));
    // $categoriesDB=getCategories();
    // print_r($categoriesDB);
    // foreach($selectedCategory as $singleCategory)
    // {
    //     foreach($categoriesDB as $array)
    //     {
    //        $catid= in_array($singleCategory,$array) ? $array['cid'] : "";
    //     }
    //     $query="Insert into post_category values(".$_SESSION['last_id'].",".$catid.")";
    //     echo $query;
    // }

    //header("Location:manage_post.php");  
}
function getPostValue($fieldname)
{
    global $singlePost;
        if($fieldname=='btnShow')
        {
            return isset($singlePost[0][$fieldname]) ? $singlePost[0][$fieldname] : "hidden";      
        }
        return isset($singlePost[0][$fieldname]) ? $singlePost[0][$fieldname] : "";
}
function setPostValue($id)
{
    global $singlePost;
    $singlePost=fetchData('blog_post',"pid=$id");
    $singlePost[0]['btnShow']="true";
}
function deletePost($id)
{
    deleteData('blog_post',"pid='".$id."'");
}
?>