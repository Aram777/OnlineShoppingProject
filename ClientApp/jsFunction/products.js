function Getproducts() {
    var url = 'http://localhost/OnlineShoppingProject/index.php/Products_ctl/products';
    var xhttp = new XMLHttpRequest();
    xhttp.open('GET', url, true);
    var jsonData = '';

    var data = '<table class="table table-hover table-bordered">'+
     '<tr class="info">'+
    '<th>PRODUCTSID</th><th>PRODUCTSCATEGORYID</th><th>PRICECATEGORYID</th><th>PRODUCNAME</th><th>PRODUCTQUANTITY</th><th>PRODUCTDESC</th><th>PRODUCTPICTURE</th><th>PRODUTMAXCAPASITY</th><th>PRODUCTORDERPOINT</th><th>PRODUCTSTATE</th><th>PRODUCTADDINGDATE</th><th>PRODUCTPRICE</th>';
         xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            jsonData = JSON.parse(xhttp.responseText);
            for (x in jsonData) {
                data +=
                    '<tr><td>' +
                    jsonData[x].PRODUCTSID +
                    '</td><td> ' +
                    jsonData[x].PRODUCTSCATEGORYID +
                    '</td><td> ' +
                    jsonData[x].PRICECATEGORYID +
                    '</td><td> ' +
                    jsonData[x].PRODUCNAME +
                    '</td><td> ' +
                    jsonData[x].PRODUCTQUANTITY +
                    '</td><td> ' +
                    jsonData[x].PRODUCTDESC +
                    '</td><td> ' +
                    jsonData[x].PRODUCTPICTURE +
                    '</td><td> ' +
                    jsonData[x].PRODUTMAXCAPASITY +
                    '</td><td> ' +
                    jsonData[x].PRODUCTORDERPOINT +
                    '</td><td> ' +
                    jsonData[x].PRODUCTSTATE +
                      '</td><td> ' +
                    jsonData[x].PRODUCTADDINGDATE +
                    '</td><td> ' +
                    jsonData[x].PRODUCTPRICE +
                    '</td>' +

                    '<td>'+
                    '<a href="">'+
                        '<button class="btn btn-danger">'+
                            '<span class="glyphicon glyphicon-remove"></span>'+
                        '</button> </a></td>'+
                        '<td>'+
                        '<a href="">'+
                            '<button class="btn btn-danger">'+
                                '<span class="glyphicon glyphicon-edit"></span>'+
                            '</button> </a></td>'+



                    '</tr>';
            }
            data += '</table>';
            document.getElementById('ResualtData').innerHTML = data;
        }
    };
    xhttp.send();
}
