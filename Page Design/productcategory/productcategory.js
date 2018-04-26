function ProdCatShow(jsonData) {
    var elmtxt = '<table style=" table-layout: fixed;" id="BaseShowTbl" class="table table-hover table-bordered table-striped " >' +
        '<tr class="info">' +
        '<th>Product Category ID</th><th>Description</th><th>Edit</th><th>Delete</th>';
    for (x in jsonData) {
        elmtxt +=
            '<tr><td>' +
            jsonData[x].ProductsCategoryId +
            '</td><td> ' +
            jsonData[x].PrdCatDescription +
            '</td>' +
            '<td> <a href="#"><button onclick="ProductCatEditData(' + jsonData[x].ProductsCategoryId + ')" class="btn btn-primary"><span class="glyphicon glyphicon-edit"></button></a></td>' +
            '<td> <a href="#"><button class="btn btn-primary"><span class="glyphicon glyphicon-remove"></button></a></td>' +
            '</tr>';
    }
    elmtxt += '</table>';
    document.getElementById("results_dyn").innerHTML = elmtxt;
}
function ProductCatEdit(ProductsCategoryId, PrdCatDescription) {
    document.getElementById("results_dyn").innerHTML = '';
    let elmtxt =

        '<label for="">Product category Id</label>' +
        '<br>' +
        '<input type="number" id="ProductCategoryId" value="' + ProductCategoryId + '" readonly>' +
        '<br>' +
        '<label for="">PrdCatDescription</label>' +
        '<br>' +
        '<input type="text" id="PrdCatDescription" value="' + PrdCatDescription + '">' +
        '<br>' +
        '<br>' +
        '<button class="btn btn-success" onclick="PrdcatSave">Save</button>' +
        '<button class="btn btn-danger" onclick="adminProductCat()">Cancel</button>';

    document.getElementById("results_dyn").innerHTML = elmtxt;

}
function ProductCatDelete(ProductCategoryId) {
    let url = 'http://localhost/OnlineShoppingProject/index.php/Productcategory_ctl/Productscategory/Productscategory';
    var xhttp = new XMLHttpRequest();

    xhttp.open('DELETE', url, true);

    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            adminProductCat();
        }
    };
    xhttp.send();
}
