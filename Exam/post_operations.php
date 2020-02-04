<?php
function displayPostList()
{
    $postList = getPosts();
    echo "<table class='table'><thead class='thead-dark'><th>ID</th><th>Category Name</th>
    <th>Title</th><th>Published At</th><th colspan=2>Actions</th></thead>";
    for($i = 0 ; $i < sizeof($postList) ; $i++ )
    {
        echo "<tr><td>".$postList[$i]['pid']."</td><td>".$postList[$i]['category']."</td>
        <td>".$postList[$i]['title']."</td><td>".$postList[$i]['published_at']."</td><td>
        <a href='add_post.php?id=".$postList[$i]['pid']."'>Edit</a>
        </td><td><a href='manage_post.php?action=delete&id=".$postList[$i]['pid']."'>Delete</a>
        </td></tr>";
    }    
    echo "</table>";
}

function getPosts()
{
    $query = "SELECT P.pid,P.title,P.published_at,GROUP_CONCAT(C.title) AS category
                FROM blog_post P INNER JOIN post_category PC ON P.pid = PC.pid
                INNER JOIN category C ON C.cid = PC.cid GROUP BY P.pid";
    return executeSQL($query);
}
function addPost($blogPostData)
{
    //print_r($blogPostData);
    if(checkExist('blog_post',"url='".$blogPostData['url']."'")){
        echo "Url Already Exist";
    }
    else{
        $selectedCategory = $blogPostData['categories'];
        unset($blogPostData['submit']);
        unset($blogPostData['categories']);
        $blogPostData['uid'] = $_SESSION['uid'];
        executeSQL(prepareData('blog_post',$blogPostData));
        $last_post_id=$_SESSION['last_id'];
        foreach($selectedCategory as $singleCategory)
        {

            $query = "Insert into post_category values(NULL,".$last_post_id.",".$singleCategory.")";
            echo $query;
            executeSQL($query);
            header("Location:manage_post.php");
        }
    }  
}
function getPostValue($fieldname)
{
    global $singlePost;
        if($fieldname == 'btnShow')
        {
            return isset($singlePost[0][$fieldname]) ? $singlePost[0][$fieldname] : "hidden";      
        }
        return isset($singlePost[0][$fieldname]) ? $singlePost[0][$fieldname] : "";
}
function setPostValue($id)
{
    global $singlePost;
    $singlePost = fetchData('blog_post',"pid=$id");
    $singlePost[0]['btnShow'] = "true";
    $singlePost[0]['btnAdd'] = "hidden";
}
function deletePost($id)
{
    deleteData('blog_post',"pid='".$id."'");
}
function updatePost($newData,$id)
{
    print_r($newData);
    unset($newData['cpassword']);
    unset($newData['update']);
    executeSQL(prepareUpdateData('blog_post',$newData,"pid='".$id."'"));
    header("Location:manage_post.php");
}
?>