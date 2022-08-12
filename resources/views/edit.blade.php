<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
                <!-- Styles -->
        <style>



#addItem {
  font-family: Arial, Helvetica, sans-serif;
  
  align:right;
}
td:nth-child(1) {
    padding-right: 20px;
}
td:nth-child(2) {
    padding-right: 20px;
}
td:nth-child(3) {
    padding-right: 20px;
}
td:nth-child(4) {
    padding-right: 20px;
}
td:nth-child(5) {
    padding-right: 20px;
}​

#addItem td {
  color: #000000;
  background-color:#F8F8FB;
  border-spacing: 20%;
}

    /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
    .row.content {height: 1500px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #1E2139;
      height: 100%;
    }
    .Button1-Default {
      background-color: #7C5DFA;
      border: none;
      color: hsl(0, 100%, 99%);
      padding: 10px 20px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      margin: 4px 2px;
      cursor: pointer;
      border-radius: 16px;
    }
   
    .Button1-Default:hover {
      background-color: #9277FF;
    }
    .Button1-Default span.icon {
      background: url(resources/assets/icon-plus.svg) no-repeat;
      float: left;
      /* width: 10px;
      height: 40px; */
     }

    .button-edit{
      background-color:#252945;
      border: none;
      color: hsl(0, 100%, 99%);
      padding: 10px 20px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      margin: 4px 2px;
      cursor: pointer;
      border-radius: 16px;
     
    }
    .button-edit plus_icon{
      width: 25px;
      height: 25px;
    }
    .delete { 
      background-color: rgb(247, 6, 6);
      border: none;
      color: hsl(0, 100%, 99%);
      padding: 10px 20px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      margin: 4px 2px;
      cursor: pointer;
      border-radius: 16px;
    }
    .pending-pill{
      background-color: #fcf34999;
      border: none;
      color: hsl(58, 34%, 50%);
      padding: 10px 20px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      margin: 4px 2px;
      cursor: pointer;
      border-radius: 16px;
    }
    .pill{
      background-color: #e9e8deeb;
      border: none;
      color: hsl(60, 2%, 50%);
      padding: 10px 20px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      margin: 4px 2px;
      cursor: pointer;
      border-radius: 16px;
    }
    .paid-pill{
      background-color: #caeb47;
      border: none;
      color: hsl(93, 76%, 39%);
      padding: 10px 20px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      margin: 4px 2px;
      cursor: pointer;
      border-radius: 16px;
    }
    .paid-button { 
      background-color: #7C5DFA;
      border: none;
      color: hsl(0, 100%, 99%);
      padding: 10px 20px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      margin: 4px 2px;
      cursor: pointer;
      border-radius: 16px;
    }
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    .container{
    }
    .inner_content{
      background-color:#DFE3FA;
      padding-left:50px;
      width:1100px;
      height:1200px
    }
    .h1
    {
      line-height: 50%;
    }
    .h2
    {
      line-height: 50%;
    }
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height: auto;} 
    }

    .body{
      font-family: Verdana, sans-serif;;
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row content">
      <div class="col-sm-1 sidenav">   
      </div>
      <div class="col-sm-9">
        <div class="row">              
          <div class="row">
           
            <form action="{{ url('update/'.$data['invoice_id']) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="container">
              <div class="inner_content">
                      <div class="row">
                          <h2>Edit #{{$data['invoice_id']}}</h2>

                          @if (\Session::has('success'))
                          <div class="alert alert-success">
                              <ul>
                                  <li>{!! \Session::get('success') !!}</li>
                              </ul>
                          </div>
                      @endif
                      </div>
                      <div class="row">
                          <span class="badge badge-success rounded-pill d-inline">Bill From</span>
                          <input type="hidden" class="form-control" value="{{$data['status']}}" name="invoice_status" id="invoice_status" required>
                      </div>
                        <div class="row">
                          <div class="form-group col-md-11">
                            <label for="sender_street_address">Street Address</label>
                            <input type="text" class="form-control" name="sender_street_address" value="{{$data['senderAddressStreet']}}" id="sender_street_address" required>
                          </div>
                        </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                          <label for="sender_city">City</label>
                          <input type="text" class="form-control" value="{{$data['senderAddressCity']}}" name="sender_city" id="sender_city" required>
                        </div>
                        <div class="form-group col-md-4">
                          <label for="sender_post_code">Post Code</label>
                          <input type="text" class="form-control" value="{{$data['senderAddressPostCode']}}"  name="sender_post_code" id="sender_post_code" required>
                        </div>
                        <div class="form-group col-md-4">
                          <label for="sender_country">Country</label>
                          <input type="text" class="form-control" value="{{$data['senderAddressCountry']}}" name="sender_country" id="sender_country" required>
                        </div>
                    </div>
                    <div class="row">
                    <span class="badge badge-success rounded-pill d-inline">Bill To</span>
                    </div>
                    <div class="row">
                      <div class="form-group col-md-11">
                        <label for="client_name">Client's Name</label>
                        <input type="text" class="form-control" value="{{$data['clientName']}}" name="client_name" id="client_name" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-md-11">
                        <label for="client_email">Client's Email</label>
                        <input type="text" class="form-control" value="{{$data['clientEmail']}}" name="client_email" id="client_email" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-md-11">
                        <label for="client_street_address">Street Address</label>
                        <input type="text" class="form-control" value="{{$data['clientAddressStreet']}}" name="client_street_address" id="client_street_address" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-md-4">
                        <label for="client_city">City</label>
                        <input type="text" class="form-control" value="{{$data['clientAddressCity']}}" name="client_city" id="client_city" required>
                      </div>
                      <div class="form-group col-md-3">
                        <label for="client_post_code">Post Code</label>
                        <input type="text" class="form-control" value="{{$data['clientAddressPostCode']}}" name="client_post_code" id="client_post_code" required>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="client_country">Country</label>
                        <input type="text" class="form-control" value="{{$data['clientAddressCountry']}}" name="client_country" id="client_country" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-md-6">
                        <label for="issue_date">Invoice Date</label>
                        <input type="date" class="form-control" value="{{$data['createdAt']}}" name="issue_date" id="issue_date" required>
                      </div>
                    <div class="form-group col-md-5">
                      <label for="payment_term">Payment Terms</label>
                      <select name="payment_terms" value="{{$data['paymentTerms']}}" class="form-control" id="payment_terms" required>
                        <option value="{{$data['paymentTerms'].' days'}}">{{$data['paymentTerms'].' days'}} </option>
                        <option value="30 days">30 days</option>
                        <option value="45 days">45 days</option>
                        <option value="90 days">3 months</option>
                    </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-11">
                        <label for="project_description">Project Description</label>
                        <input type="text" class="form-control" value="{{$data['description']}}" name="project_description" id="project_description" required>
                    </div>
                  </div>
                    <input type="hidden" class="form-control" value="{{$data['invoice_id']}}" name="invoice_id" id="invoice_id">
                    <input type="hidden" class="form-control" value="{{$data['total']}}" name="invoice_total" id="invoice_total">

                    <div class="row">
                      <div class="form-group col-md-11">
                        <table class="new_item" id="addItem">
                          <tr>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Price</th> 
                            <th>Total</th> 
                          </tr> 
                          @foreach($invoice_items as $item)
                          <tr> 
                            <input type="hidden" class="form-control" name="itemid[]" value="{{$item[0]['id']}}" />
                            <td id="col0"><input type="text" class="form-control" name="itemname[]" value="{{$item[0]['name']}}" /></td> 
                            <td id="col1"><input type="text" class="form-control" id="qty" name="qty[]" onkeyup="newFunction()" value="{{$item[0]['quantity']}}"/></td> 
                            <td id="col2"><input type="text" class="form-control" id="price" name="price[]" onkeyup="newFunction()" value="{{$item[0]['price']}}"/></td> 
                            <td id="col3"><input type="text" class="form-control" id="total" name="total[]" value="{{$item[0]['total']}}"" /></td> 
                            <td id="col4"><a href="{{ url('/delete_item/' .$item[0]['id']) }}" value="Delete Row" onclick="deleteRows()" class="delete">Delete</a>

                          </tr>  
                          @endforeach
                        </table> 
                        <div class="row">
                          <div class="form-group col-md-3">
                          <input type="button" class="Button1-Default" value="Add Row" onclick="addRows()" />
                          </div> 
                          <div class="form-group col-md-3">
                          <button type="submit" name="action" value="save" class="Button1-Default" >Save Changes</button>
                          </div>
                          <div class="form-group col-md-4">
                          <button class="Button1-Default" type="button" onclick="window.location='{{ url("/") }}'">Cancel</button></td>
                          </div>
                  </div>
                </div>
              </div>
             </form>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

<script type="text/javascript">

function newFunction() {
  var x = document.getElementById("qty").value;
  var y = document.getElementById("price").value;
 var result = parseInt(x) * parseInt(y);
 if(!isNaN(result)){
            document.getElementById('total').value = result;
        }
} 
function myFunction(row) {
    var price = +row.find('input[name^="price"]').val();
    var qty = +row.find('input[name^="qty"]').val();
    row.find('input[name^="total"]').val((price * qty).toFixed(2));
}
function addRows(){ 
	var table = document.getElementById('addItem');
	var rowCount = table.rows.length;
	var cellCount = table.rows[0].cells.length; 
	var row = table.insertRow(rowCount);
	for(var i =0; i <= cellCount; i++){
		var cell = 'cell'+i;
    cell.innerHTML="";
		cell = row.insertCell(i);
		var copycel = document.getElementById('col'+i).innerHTML;
		cell.innerHTML=copycel;
    $("table.new_item").on("change", 'input[name^="price"], input[name^="qty"], input[name^="total"]', function (event) {
      myFunction($(this).closest("tr"));
    });
	}
}
function deleteRows(){
	var table = document.getElementById('addItem');
	var rowCount = table.rows.length;
	if(rowCount > '2'){
		var row = table.deleteRow(rowCount-1);
		rowCount--;
	}
	else{
		alert('There should be atleast one row');
	}


}
 </script>
</html>
