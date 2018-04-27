

function BaseUrl() {
    //return 'https://onlinetoy.azurewebsites.net/';
    return 'http://localhost/OnlineShoppingProject/';
    // return 'http://www.students.oamk.fi/~t7abar00/';
}
function userid() {
    return 2;
}
function showDataJsn(ctlName, resName, prmName, prmVal, fncName) {
    let url = BaseUrl() + 'index.php/' + ctlName + '/' + resName;
    if (!(prmName === undefined || prmName === null)) {
        url += '/' + prmName + '/' + prmVal;
    }
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            jsonData = JSON.parse(xhttp.responseText);
            fncName(jsonData);
        }
    };
    xhttp.open("GET", url, true);
    //  xhttp.setRequestHeader('Content-type', 'application/json; charset=utf-8');
    xhttp.send();


}


//Admin Functions
function adminPriceCat() {
    document.getElementById("results_dyn").innerHTML = "";
    document.getElementById("AdminPageHeader").innerHTML = "Price Category";
    document.getElementById("AdminPageContent").style.width = "50%";
    document.getElementById("AdminPageContent").style.height = "60%";
    modal = document.getElementById('AdminPage');

    span = document.getElementById('adminclose');
    modal.style.display = "block";
    /*   span.onclick = function () {
          modal.style.display = "none";
      } */
    showDataJsn('Pricecategory_ctl', 'pricecategory', null, null, PriceCatShow);

}

function PriceCatShow(jsonData) {
    var elmtxt = '<button onclick=" PriceCatInsert() ">Add new</button> <br>' +
        '<table id="BaseShowTbl" class="table table-hover table-bordered table ">' +
        '<tr class="info">' +
        '<th>Price Category ID</th><th>Perecent</th><th>Edit</th><th>Delete</th>';
    for (x in jsonData) {
        elmtxt +=
            '<tr><td>' +
            jsonData[x].PriceCategoryId +
            '</td><td> ' +
            jsonData[x].PriceCatPerecent +
            '</td>' +
            '<td> <a href="javascript:PriceCatEdit(' + jsonData[x].PriceCategoryId + ',' + jsonData[x].PriceCatPerecent + ');"> <button class="btn btn-primary"><span class="glyphicon glyphicon-edit"></button></a></td>' +
            '<td> <a href="javascript:PriceCatDelete(' + jsonData[x].PriceCategoryId + ');"> <button class="btn btn-primary"><span class="glyphicon glyphicon-remove"></button></a></td>' +
            '</tr>';
    }
    elmtxt += '</table>';
    document.getElementById("results_dyn").innerHTML = elmtxt;
}

function PriceCatEdit(PriceCategoryId, PriceCatPercent) {
    document.getElementById("results_dyn").innerHTML = '';
    let elmtxt =

        '<label for="">Price category Id</label>' +
        '<br>' +
        '<input type="text" id="PriceCategoryId" value="' + PriceCategoryId + '" readonly>' +
        '<br>' +
        '<label for="">Percent</label>' +
        '<br>' +
        '<input type="number" id="PriceCatPercent" value="' + PriceCatPercent + '">' +
        '<br>' +
        '<br>' +
        '<button class="btn btn-success" onclick="PricecatSave(2)">Save</button>' +
        '<button class="btn btn-danger" onclick="adminPriceCat()">Cancel</button>';

    document.getElementById("results_dyn").innerHTML = elmtxt;

}
function PriceCatInsert() {
    document.getElementById("results_dyn").innerHTML = '';
    let elmtxt =

        '<label for="">Price category Id</label>' +
        '<br>' +
        '<input type="text" id="PriceCategoryId" value="" readonly>' +
        '<br>' +
        '<label for="">Percent</label>' +
        '<br>' +
        '<input type="number" id="PriceCatPercent" value="">' +
        '<br>' +
        '<br>' +
        '<button class="btn btn-success" onclick="PricecatSave(1)">Save</button>' +
        '<button class="btn btn-danger" onclick="adminPriceCat()">Cancel</button>';

    document.getElementById("results_dyn").innerHTML = elmtxt;

}
function PriceCatDelete(PriceCategoryId) {
    let url = BaseUrl() + 'index.php/Pricecategory_ctl/pricecategory/PriceCategoryId/' + PriceCategoryId.toString();
    var xhttp = new XMLHttpRequest();
    xhttp.open('DELETE', url, true);
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            adminPriceCat();
        }
    };
    xhttp.send();

}

function PricecatSave(mtdflag) {
    let url = BaseUrl() + 'index.php/Pricecategory_ctl/pricecategory';

    var data2 = {};
    if (mtdflag == 2)
        data2.PriceCategoryId = parseInt(document.getElementById('PriceCategoryId').value);
    data2.PriceCatPercent = parseFloat(document.getElementById('PriceCatPercent').value);

    var jsonData = JSON.stringify(data2);
    var xhttp = new XMLHttpRequest();
    if (mtdflag == 2)
        xhttp.open('PUT', url, true);
    else
        xhttp.open('POST', url, true);
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 201) {
            adminPriceCat();
        }
    };
    //xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.setRequestHeader('Content-type', 'application/json; charset=utf-8');
    xhttp.send(jsonData);
}
