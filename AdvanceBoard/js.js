/**
 * Created by xiaolongzhou on 8/11/17.
 */

function homePage()
{
    this.open("http://138.197.198.28", "_self");
}

function chooseMethod()
{
    var myMethod = document.getElementsByClassName("getMethod").value;
    document.getElementsByClassName("myForm").method = myMethod;
}