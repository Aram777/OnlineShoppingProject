function edit_row(no)
{
 document.getElementById("edit_button"+no).style.display="none";
 document.getElementById("save_button"+no).style.display="block";

 var Products_ID=document.getElementById("Products_ID_row"+no);
 var Price_Category_ID=document.getElementById("Price_Category_ID_row"+no);
 var Product_Name=document.getElementById("Product_Name_row"+no);
var Product_Quantity=document.getElementById("Product_Quantity_row"+no);
var Product_DESC_ID=document.getElementById("Product_DESC_ID_row"+no);
var Product_Picture=document.getElementById("Product_Picture_row"+no);
var Product_Max_Capacity=document.getElementById("Product_Max_Capacity_row"+no);
var Product_Order_point=document.getElementById("Product_Order_point_row"+no);
 var Products_ID_data=Products_ID.innerHTML;
 var Price_Category_ID_data=Price_Category_ID.innerHTML;
 var Product_Name_data=Product_Name.innerHTML;
var Product_Quantity_data=Product_Quantity.innerHTML;
var Product_DESC_ID_data=Product_DESC_ID.innerHTML;
var Product_Picture_data=Product_Picture.innerHTML;
var Product_Max_Capacity_data=Product_Max_Capacity.innerHTML;
var Product_Order_point_data=Product_Order_point.innerHTML;
 Products_ID.innerHTML="<input type='text' id='Products_ID_text"+no+"' value='"+Products_ID_data+"'>";
 Price_Category_ID.innerHTML="<input type='text' id='Price_Category_ID_text"+no+"' value='"+Price_Category_ID_data+"'>";
 Product_Name.innerHTML="<input type='text' id='Product_Name_text"+no+"' value='"+Product_Name_data+"'>";
Product_Quantity.innerHTML="<input type='text' id='Product_Quantity_text"+no+"' value='"+Product_Quantity_data+"'>";
Product_DESC_ID.innerHTML="<input type='text' id='Product_DESC_ID_text"+no+"' value='"+Product_DESC_ID_data+"'>";
Product_Picture.innerHTML="<input type='text' id='Product_Picture_text"+no+"' value='"+Product_Picture_data+"'>";
Product_Max_Capacity.innerHTML="<input type='text' id='Product_Max_Capacity_text"+no+"' value='"+Product_Max_Capacity_data+"'>";
Product_Order_point.innerHTML="<input type='text' id='Product_Order_point_text"+no+"' value='"+Product_Order_point_data+"'>";
}

function save_row(no)
{
 var Products_ID_val=document.getElementById("Products_ID_text"+no).value;
 var Price_Category_ID_val=document.getElementById("Price_Category_ID_text"+no).value;
 var Product_Name_val=document.getElementById("Product_Name_text"+no).value;
 var Product_Quantity_val=document.getElementById("Product_Quantity_text"+no).value;
 var Product_DESC_ID_val=document.getElementById("Product_DESC_ID_text"+no).value;
 var Product_Picture_val=document.getElementById("Product_Picture_text"+no).value;
 var Product_Max_Capacity_val=document.getElementById("Product_Max_Capacity_text"+no).value;
 var Product_Order_point_val=document.getElementById("Product_Order_point_text"+no).value;
 document.getElementById("Products_ID_row"+no).innerHTML=Products_ID_val;
 document.getElementById("Price_Category_ID_row"+no).innerHTML=Price_Category_ID_val;
 document.getElementById("Product_Name_row"+no).innerHTML=Product_Name_val;
 document.getElementById("Product_Quantity_row"+no).innerHTML=Product_Quantity_val;
 document.getElementById("Product_DESC_ID_row"+no).innerHTML=Product_DESC_ID_val;
 document.getElementById("Product_Picture_row"+no).innerHTML=Product_Picture_val;
 document.getElementById("Product_Max_Capacity_row"+no).innerHTML=Product_Max_Capacity_val;
 document.getElementById("Product_Order_point_row"+no).innerHTML=Product_Order_point_val;
 document.getElementById("edit_button"+no).style.display="block";
 document.getElementById("save_button"+no).style.display="none";
}


function delete_row(no)
{
 document.getElementById("row"+no+"").outerHTML="";
}

function add_row()
{
 var new_Products_ID=document.getElementById("new_Products_ID").value;
 var new_Price_Category=document.getElementById("new_Price_Category").value;
 var new_Product_Name=document.getElementById("new_Product_Name").value;
/* var new_Product_Quantity=document.getElementById("Product_Quantity").value;
 var new Product_DESC_ID=document.getElementById("Product_DESC_ID").value;
 var new Product_Picture=document.getElementById("Product_Picture").value;
 var new Product_Max_Capacity=document.getElementById("Product_Max_Capacity").value;
 var new Product_Order_point=document.getElementById("Product_Order_point").value;
 */
 var table=document.getElementById("data_table");
 var table_len=(table.rows.length) -1;
 var row = table.insertRow(table_len).outerHTML="<tr id='row"+table_len+"'><td id='Products_ID_row"+
 table_len+"'>"+new_Products_ID+"</td><td id='Price_Category_row"+table_len+"'>"+new_Price_Category+
 "</td><td id='Product_Name_row"+table_len+"'>"+new_Product_Name+"</td><td><input type='button' id='edit_button"+
 table_len+"' value='Edit' class='edit' onclick='edit_row("+table_len+")'> <input type='button' id='save_button"+
 table_len+"' value='Save' class='save' onclick='save_row("+table_len+")'> <input type='button' value='Delete'  class='delete'onclick='delete_row("+
 table_len+")'></td></tr>";

 document.getElementById("new_Product_ID").value="";
 document.getElementById("new_Price_Category").value="";
 document.getElementById("new_Product_Name").value="";
}
