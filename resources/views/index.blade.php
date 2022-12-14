<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="jquery.min.js"></script>
        <link href="bootstrap.min.css" rel="stylesheet" >
        <title>Index</title>

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
                /* width:55%!important; */
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
                width:55%!important;
            }
        </style>
       
    </head>

    <body class="bg-dark">

        <div class="row">
            <div class="col-2 "> </div>
            <div class="col-8 ">
                <div class=" w-75 bg-warning my-5 mx-auto h-75">
                    <!-- <br><p style="text-align: right;padding: 10px;font-size: 20px;">برای دریافت آخرین قیمت ارز دیجیتال مورد نیاز ، لطفا سمبل مورد نظر خود را وارد کنید</p><br> -->
                    <br><p style="text-align: right;padding: 10px;font-size: 20px;">برای دریافت آخرین قیمت ارز دیجیتال مورد نیاز ، لطفا سمبل مورد نظر خود را انتخاب کنید</p><br>

                    <div class="row">
                        
                        <div class="col-12 mx-auto px-4 mb-3" style="text-align:right">
                            <!-- <input class="" style="text-align:center; width:50%" type="text" id="symbol"  placeholder=" ... لطفا نماد مورد نظر خود را وارد کنید"> -->
                            
                            <select style="text-align:center; width:50%" id="symbol">
                                <option value="nothing">لطفا سمبل مورد نظر خود را انتخاب</option>
                                @foreach($symbols as $symbol)
                                    <option value="{{$symbol}}">{{$symbol}}</option>
                                @endforeach
                            </select>

                        </div>
                            
                        <div class="col-12 mx-auto px-4  mb-3" style="text-align:right">
                            <span class="btn bg-dark text-warning up" style=" width:50%"> دریافت جدیدترین قیمت</span>
                        </div>

                        <div class="col-12 mx-auto px-4" id="price-result" style="text-align:right;display:none;">
                            <p class="text-center" style="float: right;width:50%" id="price-box"> <span>$</span>به روز ترین قیمت ارز : <span id="price"> 0 </span></p>
                        </div>

                        <div class="col-12 mx-auto px-4" id="price-result2" style="text-align:right;display:none;">
                            <p class="text-center" style="float: right;width:50%" id="price-box2"> <span> $ </span>به روز ترین قیمت (گرد شده) ارز : <span id="price2"> 0 </span></p>
                        </div>

                    </div>
                    
                    <div class="w-100 h-25 text-center" style="background:#dba900;">
                    
                        <a class="btn btn-dark text-warning w-75 mt-4" href="{{route('showAllItem')}}">نمایش لیست کامل</a>

                    </div>

                </div>

                <br><br>

            </div>

            <div class="col-2"> </div>

        </div>

    <script> // دریافت اطلاعات با استفاده از کنترلر
        $('.up').click(function(){
            var symbol = $('#symbol').val();
            if(symbol == 'nothing')
            {
                alert('کاربر گرامی ، لطفا سمبل مورد نظر را انتخاب کنید')
                $('.up').html('دریافت جدیدترین قیمت')
                $('#price-result').fadeOut(500);
                $('#price-result2').fadeOut(400);

            }else
            {   

                $('.up').html('لطفا صبر کنید');
                $.ajax({
                    type: "GET",
                    url: "api/v1/get/latest/price/"+symbol,
                    data: {symbol:symbol},
                    success: function (response) {
                        
                        if(response == 404)
                        {
                            alert('کاربر گرامی ، سمبل وارد شده صحیح نمی باشد. توجه داشته باشید باید از حروف بزرگ انگلیسی استفاده کنید')
                            $('#price-result').fadeOut(500);
                            $('#price-result2').fadeOut(400);
                            $('.up').html('دریافت جدیدترین قیمت')
                        }else
                        {
                            $('#price').html(response.price)
                            $('#price2').html(Math.round(response.price * 100) / 100)
                            $('#price-result').fadeIn(400);
                            $('#price-result2').fadeIn(500);
                            $('.up').html('به روز رسانی')
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert('کاربر گرامی ، سمبل وارد شده صحیح نمی باشد. توجه داشته باشید باید از حروف بزرگ انگلیسی استفاده کنید')
                        $('.up').html('دریافت جدیدترین قیمت')
                        $('#price-result').fadeOut(500);
                        $('#price-result2').fadeOut(400);
                    }
                });
            }
        })

        $('#symbol').change(function(){
            $('#price-result').fadeOut(500);
            $('#price-result2').fadeOut(400);
            var symbol = $('#symbol').val();
            if(symbol == 'nothing')
            {
                // alert('کاربر گرامی ، لطفا سمبل مورد نظر را انتخاب کنید')
                $('.up').html('دریافت جدیدترین قیمت')
                $('#price-result').fadeOut(500);
                $('#price-result2').fadeOut(400);

            }else
            {   
                $('.up').html('لطفا صبر کنید');
                $.ajax({
                    type: "GET",
                    url: "api/v1/get/latest/price/"+symbol,
                    data: {symbol:symbol},
                    success: function (response) {                        
                        if(response == 404)
                        {
                            alert('کاربر گرامی ، سمبل وارد شده صحیح نمی باشد. توجه داشته باشید باید از حروف بزرگ انگلیسی استفاده کنید')
                            $('#price-result').fadeOut(500);
                            $('#price-result2').fadeOut(400);
                            $('.up').html('دریافت جدیدترین قیمت')
                        }else
                        {
                            $('#price').html(response.price)
                            $('#price2').html(Math.round(response.price * 100) / 100)
                            $('#price-result').fadeIn(400);
                            $('#price-result2').fadeIn(500);
                            $('.up').html('به روز رسانی')
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert('کاربر گرامی ، سمبل وارد شده صحیح نمی باشد. توجه داشته باشید باید از حروف بزرگ انگلیسی استفاده کنید')
                        $('.up').html('دریافت جدیدترین قیمت')
                        $('#price-result').fadeOut(500);
                        $('#price-result2').fadeOut(400);
                    }
                });
            }
        });
    </script>

    <!-- <script> // دریافت اطلاعات به صورت مستقیم از api با استفاده از ajax
            $('.up').click(function(){
                var symbol = $('#symbol').val();
                if(symbol.length == 0)
                {
                    alert('کاربر گرامی ، لطفا سمبل مورد نظر را وارد کنید')
                    $('.up').html('دریافت جدیدترین قیمت')
                    $('#price-result').fadeOut(500);
                    $('#price-result2').fadeOut(400);
                }else
                {   
                    $('.up').html('لطفا صبر کنید');
                    const url = 'https://api.binance.com/api/v3/ticker/price?symbol=' + symbol;
                    $.ajax({
                        type: "GET",
                        url: url,
                        success: function (response) {
                            if(response)
                            {
                                $('#price').html(response.price)
                                $('#price2').html(Math.round(response.price * 100) / 100)
                                $('#price-result').fadeIn(400);
                                $('#price-result2').fadeIn(500);
                                $('.up').html('به روز رسانی')
                            }else
                            {
                                alert('کاربر گرامی ، سمبل وارد شده صحیح نمی باشد')
                                $('#price-result').fadeOut(500);
                                $('#price-result2').fadeOut(400);
                                $('.up').html('دریافت جدیدترین قیمت')
                            }     
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            alert('کاربر گرامی ، لطفا سمبل مورد نظر را صحیح وارد کنید')
                            $('.up').html('دریافت جدیدترین قیمت')
                            $('#price-result').fadeOut(500);
                            $('#price-result2').fadeOut(400);
                        }
                    });
                }
            })
    </script> -->

    </body>
</html>
