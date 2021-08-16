function check(){
var question = confirm("Are you sure?");
if(question)
{
    return true;
}else
{
    alert("Thanks for not choosing to delete");
    return false;
}
}
