function Getorders() {
    alert('ok');
    var url = 'http://localhost/OnlineShoppingProject/index.php/Orders_ctl/orders';
    var xhttp = new XMLHttpRequest();
    xhttp.open('GET', url, true);
    var jsonData = '';

    var data = '<table class="table table-hover table-bordered" border="1">'+
     '<tr class="info">'+
    '<th>PRODUCTSID</th><th>ORDERDATE</th><th>ORDERSTATUS</th><th>PRODUCTRATE</th><th>ORDERQUANTITY</th><th>ORDERPRICE</th>';

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
                        'Update</button> </a></td>'+
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
function Addorder(){
    var url = 'http://localhost/OnlineShoppingProject/index.php/Orders_ctl/orders';
    var xhttp = new XMLHttpRequest();
    xhttp.open('POST', url, true);
    var form = document.getElementById('OrderForm');
    var formData = new FormData(form);
    xhttp.onreadystatechange = function() {
      if (xhttp.readyState == 4 && xhttp.status == 201) {
        document.getElementById('ResualtData').innerHTML = 'order added succesfully';
      } else {
        document.getElementById('ResualtData').innerHTML = 'Something went wrong';
      }
    };
    xhttp.send(formData);
  }
  function UpdateOrder() {
    var url = 'http://localhost/OnlineShoppingProject/index.php/Orders_ctl/orders';
    var xhttp = new XMLHttpRequest();
    xhttp.open('PUT', url, true);
    var data = {};
    data.id = parseInt(document.getElementById('update_SYSTEMUSERSID').value);
    data.id = parseInt(document.getElementById('update_PRODUCTSID').value);
    data.date = document.getElementById('update_ORDERDATE').value;
    data.text = document.getElementById('update_ORDERSTATUS').value;
    data.text = document.getElementById('update_PRODUCTRATE').value;
    data.text = document.getElementById('update_ORDERQUANTITY').value;
    data.text = document.getElementById('update_ORDERPRICE').value
   var jsonData = JSON.stringify(data);
    xhttp.onreadystatechange = function() {
      if (xhttp.readyState == 4 && xhttp.status == 201) {
        document.getElementById('ResualtData').innerHTML = 'User updated succesfully';
      } else {
        document.getElementById('ResualtData').innerHTML = 'Something went wrong';
      }
    };
    xhttp.setRequestHeader('Content-type', 'application/json; charset=utf-8');
    xhttp.send(jsonData);
  }