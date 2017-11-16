/**
 * Created by xiaolongzhou on 8/11/17.
 */

function homePage()
{
    this.open("http://138.197.198.28", "_self");
}

function chooseMethod()
{
    var myMethod = document.getElementsByClassName("getMethod")[0].value;
    document.getElementsByClassName("myForm")[0].method = myMethod;
}
