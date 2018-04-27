

function makecart() {
  document.getElementById('shivadiv').innerHTML = '';
  var url = 'http://localhost/OnlineShoppingProject/index.php/Orders_ctl/userorders/SystemUsersId/2';
  var xhttp = new XMLHttpRequest();
  xhttp.open('GET', url, true);
  var jsonData = '';
  var totprc=0
  var data = '';

  xhttp.onreadystatechange = function () {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      jsonData = JSON.parse(xhttp.responseText);
      for (x in jsonData) {
        totprc+=jsonData[x].OrderPrice;
        data +=

          '<div class="Item">' +
          '<div class="Itemimage">' +
          '<img src="http://localhost/OnlineShoppingProject/images/' + jsonData[x].ProductPicture + '">' +
          '</div>' +
          '<div class="Itemdescription">' +
          '<div class="Itemname">' + jsonData[x].ProductName + '</div>' +
          '<p class="Itemdetails">' + jsonData[x].ProductDesc + '</p>' +
          '</div>' +
          '<div class="Itemprice">' + jsonData[x].OrderPrice + '</div>' +
          '<div class="Itemquantity">' +
          '<input type="number" value="1" min="1">' +
          '</div>' +
          '<div class="Itemremove">' +
          '<button class="Removeitem" onclick="deletecart(' + jsonData[x].OrdersId + ')">' +
          'Remove' +
          '</button>' +
          '</div>' +
          '<div class="Productsprice">'+jsonData[x].OrderPrice*jsonData[x].OrderQuantity+'</div>' +
          '</div>';

      }
      document.getElementById('shivadiv').innerHTML = data;
      
      document.getElementById('Cartsubtotal').innerHTML = '€'+totprc.toString();
    }
  };
  xhttp.send();

}
function deletecart(OrdersId) 
{
  var delok = confirm('Are you sure to delete this order?');
  if (delok) 
  {
    var url = 'http://localhost/OnlineShoppingProject/index.php/Orders_ctl/orders/OrdersId/' + OrdersId;

    var xhttp = new XMLHttpRequest();
    xhttp.open('DELETE', url, true);
    var jsonData = '';
    var data = '';
    xhttp.onreadystatechange = function () {
      if (xhttp.readyState == 4 && xhttp.status == 200) {

        makecart();
      }
    };
    xhttp.send();

  }
}
