function Getorders() {
    var url = 'http://localhost/OnlineShoppingProject/index.php/Orders_ctl/orders';
    var xhttp = new XMLHttpRequest();
    xhttp.open('GET', url, true);
    var jsonData = '';

    var data = '<table class="table table-hover table-bordered">'+
     '<tr class="info">'+
    '<th>Products ID</th><th>Order state</th><th>Order status</th><th>User Type</th><th>Situation</th><th>Address</th><th>Delete</th><th>Edit</th>';

    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            jsonData = JSON.parse(xhttp.responseText);
            for (x in jsonData) {
                data +=
                    '<tr><td>' +
                    jsonData[x].PRODUCTSID +
                    '</td><td> ' +
                    jsonData[x].ORDERDATE +
                    '</td><td> ' +
                    jsonData[x].ORDERSTATUS +
                    '</td><td> ' +
                    jsonData[x].PRODUCTRATE +
                    '</td><td> ' +
                    jsonData[x].ORDERQUANTITY +
                    '</td><td> ' +
                    jsonData[x].ORDERPRICE +
                    '</td>'+
                    
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