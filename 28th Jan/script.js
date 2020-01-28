function showOther(checkbox)
{
    var div=document.getElementById('otherInfo');
    var status=checkbox.checked ? div.setAttribute('style','display : block') : div.setAttribute('style','display : none') ;
}