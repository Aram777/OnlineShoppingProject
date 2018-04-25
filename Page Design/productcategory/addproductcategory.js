function Addproductcategory() {
  var url = 'http://localhost/rest_api/index.php/Productscategory_ctl/productscategory';
  var xhttp = new XMLHttpRequest();
  xhttp.open('POST', url, true);
  var form = document.getElementById('prdcatfrm');
  var formData = new FormData(form);
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 201) {
      document.getElementById('Resualt').innerHTML = 'Products category added succesfully';
    } else {
      document.getElementById('Resualt').innerHTML = 'Something went wrong';
    }
  };
  xhttp.send(formData);
}
