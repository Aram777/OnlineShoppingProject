function Getpricecategory() {
    var url = 'http://localhost/OnlineShoppingProject/index.php/Pricecategory_ctl/pricecategory';
    var xhttp = new XMLHttpRequest();
    xhttp.open('GET', url, true);
    var jsonData = '';

    var data = '<table class="table table-hover table-bordered">'+
     '<tr class="info">'+
    '<th>Products ID</th><th>PRICECATPERECENT</th>';

    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            jsonData = JSON.parse(xhttp.responseText);
            for (x in jsonData) {
                data +=
                    '<tr><td>' +
                    jsonData[x].PRODUCTSID +
                    '</td><td> ' +
                    '<tr><td>' +
                    jsonData[x].PRICECATPERECENT +
                    '</td><td> ' +
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