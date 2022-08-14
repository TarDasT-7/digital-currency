<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script src="jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" >
        <link href="bootstrap.min.css" rel="stylesheet" >

        <title>List</title>
        <style>
            body{
                margin:0;
                padding:0;
                overflow-x: hidden;
            }

            #symbol , #price-box, #price-box2{
                border: none;
                outline: none;
                height: 35px;
                border-radius: 25px;
                padding: 5px 10px;
                background: #202529;
                color: #ffc500;
                transition:.5s;
            }
            #symbol::placeholder{
                color: #ffc500;
                opacity: .8;
            }

            #symbol:focus{
                width:45%!important;
            }  

            .submit{
                padding: 5px 20px;
                margin: 20px 0;
                border: none;
                outline: none;
                cursor: pointer;
                border-radius: 20px;
                opacity: 1;
                transition:.5s;
            }
            .submit:hover{
                opacity: .9;
            }

            .submit:focus{
                width:45%!important;
            }

            #loading{
                height: 100%;
                width: 100%;
                background: black;
                z-index: 99;
                position: fixed;
                text-align: center;
                color: #ffca00;
                padding: 40px 0;
            }
        </style>

        <style>
            table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 90%;
                margin:0 auto 20px;
            }
            
            td, th {
                border: 1px solid #dedede;
                text-align:center;
                padding: 8px;
            }

            tr:nth-child(even) {
            background-color: #dedede;
            }
        </style>
       
    </head>
    <body class="bg-dark">
        <div id="loading"><h1>...درحال دریافت اطلاعات ، لطفا منتظر بمانید</h1></div>

        <div class="row">
            <div class="col-2 "> </div>
            <div class="col-8 ">
                
                <div class=" w-75 bg-warning my-5 mx-auto">
                    <br>
                    <p style="text-align: right;padding: 10px;font-size: 20px;"> به روزترین لیست قیمت ارز های دیجیتال /  <a class="" href="{{route('home')}}">بازگشت</a> </p>
                    <br>

                    
                    <table id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Symbol</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($items as $key=>$item)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$item->symbol}}</td>
                                    <td>{{$item->price}}</td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                      
                    </table>
                   
                </div>
                <br><br>
            </div>
            <div class="col-2"> </div>
        </div>

        <script>
            $(document).ready(function () {
                setTimeout(() => {
                    $('#loading').remove();
                }, 1000);
                $('#example').DataTable({
                    "lengthMenu": [ [2, 3, 5, 10, 25, 50, 100, 200, 500, 1000, 2000, -1], [2, 3, 5, 10, 25, 50, 100, 200, 500, 1000, 2000, "All"] ],
                    search: {
                        return: true,
                    },
                });

                $('.dataTables_filter input')
                .off()
                .on('keyup', function() {
                    $('#example').DataTable().column(1).search(this.value.trim(), false, false).draw();
                });                      
            });
        </script>


    </body>
</html>
