
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
    
    /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
    /* .row.content {
        height: 1500px;
        background-color: #F8F8FB;
    } */
    


    #table {
  font-family: Arial, Helvetica, sans-serif;
  
  align:right;
}


#table td {
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
      background-color:#DFE3FA;
      padding-left:50px;
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
      background-color:#DFE3FA;
      width:600px;

      font-family: Verdana, sans-serif;;
    }
        </style>
    </head>

    <body>
        <div class="container-fluid">
            <div class="row content">
                <div class="col-sm-1 sidenav">   
                </div>
                <div>
                <div style="padding-left:70px;text-align:center;background-color:#dfe3fa"class="column middle">
                <div style="text-align: left" class="col-lg-2"><a href="{{ url('/' )}}"><svg width="7" height="10" xmlns="http://www.w3.org/2000/svg"><path d="M6.342.886L2.114 5.114l4.228 4.228" stroke="#9277FF" stroke-width="2" fill="none" fill-rule="evenodd"/></svg><b> Go back</b></a>
                </div>
                    <div style="text-align: right;"class="col-md-2">
                            <?php if($data['status'] == 'paid'){  ?>
                                <b><h5>Status<span class ="paid-pill"> {{$data['status']}}</span></h5></b>
                            <?php } elseif($data['status'] == 'pending') { ?>
                                <b><h5>Status<span class ="pending-pill"> {{$data['status']}}</span></h5></b>
                            <?php } else { ?>
                                <b><h5>Status<span class ="pill"> {{$data['status']}}</span></h5></b>
                            <?php } ?>
                    </div>
                    <div style="text-align: right;" class="col-lg-5">
                            <a href="{{ url('/edit/'.$data['invoice_id'] )}}" class="button-edit">Edit</a>
                            <a href="{{ url('/delete/'.$data['invoice_id'] )}}" class="delete">Delete</a>
                            <a href="{{ url('/paid/'.$data['invoice_id'] )}}" class="paid-button">Mark as Paid</a>
                         
                    </div>
                </div>
                </div>
                    <div style=" border-radius:25px;height:600px;width:800px;background-color:#dfe3fa;margin-left:400px; margin-top:50px">
                    <div class="column middle">
                    
                    <article>
                            <div class="col-lg-10">
                            <h3><b>#{{$data['invoice_id']}}</b></h3>
                            <h5>{{$data['description']}}</h5>
                            </div>
                    <div class="col-lg-12">
                            
                            <p align="right">{{$data['senderAddressStreet']}} </p>
                            <p align="right">{{$data['senderAddressCity']}}</p>
                            <p align="right">{{$data['senderAddressPostCode']}}</p>
                            <p align="right">{{$data['senderAddressCountry']}}</p>
                            </div>
                </article>

                        <article>
                        <div class="col-lg-5">
                            <p align> <h5><b>Invoice Date</b></h5></p>
                            <p>{{$data['createdAt']}}</p>
                            <p><h5></b>Payment Due</b></h5></p>
                            <p>{{$data['paymentDue']}}</p>
                        </div>
                        </article>

                        <div class="col-lg-3">
                            <p> <h5><b>Bill To</b></h5></p>
                            <p>{{$data['clientAddressStreet']}}</p>
                            <p>{{$data['clientAddressCity']}}</p>
                            <p>{{$data['clientAddressPostCode']}}</p>
                            <p>{{$data['clientAddressCountry']}}</p>

                        </div>
                        <div class="col-lg-4">
                                <p> <h5><b>Sent To</b></h5></p>
                                <p>{{$data['clientEmail']}}</p>
                         </div>
                         
                    </div>
                    <div>
                        <div class="row">
                        <div class="col-lg-12">
                         <table class="new_item" id="table">
                            <div class="row">
                                <div class="col-lg-4"><h4><b>Item Name</b></h4></div>
                                <div class="col-lg-4"><h5><b>Quantity</b></h5></div>
                                <div class="col-lg-2"><h5><b>Price</h5></b></div> 
                                <div class="col-lg-2"><h5><b>Total</b></h5></div> 
                            </div> 
                            @foreach($invoice_items as $item)
                              <div class="row">
                                <div class="col-lg-4"><h5>{{$item[0]['name']}}</h5></div>
                                <div class="col-lg-4"><h5>{{$item[0]['quantity']}}</h5></div> 
                                <div class="col-lg-2"><h5>${{$item[0]['price']}}</h5></div> 
                                <div class="col-lg-2"><h5>${{$item[0]['total']}}</h5></div> 
                              </div>      
                            @endforeach
                          </table> 
                            </div>
                            <div class="col-lg-12">
                                <h4>Grand Total : ${{$data['total']}}</h1>
                            </div>
                         </div>
                    </div>
                </div>
            </div>
            
    </body>
</html>