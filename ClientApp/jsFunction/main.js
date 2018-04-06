function Getsystemusers() {
    var url = 'http://localhost/OnlineShoppingProject/index.php/Systemusers_ctl/systemusers';
    var xhttp = new XMLHttpRequest();
    xhttp.open('GET', url, true);
    var jsonData = '';

    var data = '<table class="table table-hover table-bordered">'+
     '<tr class="info">'+
    '<th>First Name</th><th>Last Name</th><th>Email</th><th>User Type</th><th>Situation</th><th>Address</th><th>Delete</th><th>Edit</th>';

    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            jsonData = JSON.parse(xhttp.responseText);
            for (x in jsonData) {
                data +=
                    '<tr><td>' +
                    jsonData[x].USERFIRSTNAME +
                    '</td><td> ' +
                    jsonData[x].USERFIRSTNAME +
                    '</td><td> ' +
                    jsonData[x].USEREMAIL +
                    '</td><td> ' +
                    jsonData[x].usertypetxt +
                    '</td><td> ' +
                    jsonData[x].userstattxt +
                    '</td><td> ' +
                    jsonData[x].USERADDRESS +
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

