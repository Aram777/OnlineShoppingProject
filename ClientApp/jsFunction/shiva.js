
function makecart(){
    document.getElementById('shivadiv').innerHTML ='';
    var url = 'http://localhost/OnlineShoppingProject/index.php/Orders_ctl/userorders/SystemUsersId/2';
    var xhttp = new XMLHttpRequest();
    xhttp.open('GET', url, true);
    var jsonData = '';

    var data = '';

    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            jsonData = JSON.parse(xhttp.responseText);
            for (x in jsonData) {
                data +=

                '<div class="Item">'+
                '<div class="Itemimage">'+
                  '<img src="http://localhost/OnlineShoppingProject/images/'+jsonData[x].ProductPicture+'">'+
                '</div>'+
                '<div class="Itemdescription">'+
                  '<div class="Itemname">'+ jsonData[x].ProductName+'</div>'+
                  '<p class="Itemdetails">'+ jsonData[x].ProductDesc+'</p>'+
                '</div>'+
                '<div class="Itemprice">'+jsonData[x].OrderPrice+'</div>'+
                '<div class="Itemquantity">'+
                  '<input type="number" value="1" min="1">'+
                '</div>'+
                '<div class="Itemremove">'+
                  '<button class="Removeitem" onclick="removefunction('+jsonData[x].OrdersId+')">'+
                    'Remove'+
                  '</button>'+
                '</div>'+
                '<div class="Productsprice">10</div>'+
              '</div>';
            
            }
            document.getElementById('shivadiv').innerHTML = data;
        }
    };
    xhttp.send();

}
function deleteOrders(OrdersId) {
  var delete_iOrdersId = document.getElementById('shivadiv').value;
  var url = 'http://localhost/OnlineShoppingProject/index.php/Orders_ctl/userorders/SystemUsersId/2'; + delete_OrdersId;
  var xhttp = new XMLHttpRequest();
  xhttp.open('REMOVE', url, true);
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      document.getElementById('shivadiv').innerHTML = 'Orders from shopping cart deleted succesfully';
    } else {
      document.getElementById('shivadiv').innerHTML = 'Something went wrong';
    }
  };
  xhttp.send();

  }

 