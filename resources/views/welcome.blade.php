<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Short URL</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> 
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link rel="stylesheet" href="/style.css">
    </head>
    <body >
        <div class="container mx-auto mtb">
            <img src="/img/mini-logo.png"> <br>
            <p class="text-blue ml-3">Make your link shorter.</p>
        
            <div class="bg-blue p-4">
               <form method="post">
                    <div class="row">
                        <div class="col-10">
                            <input type="text" name="" placeholder="Paste your link here ..." class="form-control" id="url">
                        </div>
                        <div class="col-2 text-right">
                            <button type="submit" id="btn-submit" class="btn btn-transparent"><i class="fa text-white fa-1x fa-long-arrow-alt-right"></i></button>
                        </div>
                    </div>
               </form>
            </div>
        </div>
        <br>
        <div class="container " id="box-url" style="display: none;">
            <div class="card">
                <div class="card-body card-shadow" style="border-radius: 10px;">
                    <b>Your Short URL :</b>
                    <div >
                        <input type="text" class="short-url" id="short-url" value="https://localhost:8000/sas90"> <a href="javascript:void(0);" id="copy" class="text-dark"><i  class="fa fa-1x fa-copy float-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    $('#btn-submit').click(function(e){
        e.preventDefault();
        $('#box-url').fadeOut();
        $.ajax({
                        /* the route pointing to the post function */
                        url: "{{route('link/store')}}?url="+$('#url').val(),
                        type: 'GET',
                        dataType: 'JSON',
                        success: function (data) { 
                            $('#box-url').fadeIn();
                            $('#short-url').val(data.url);
                        }
                    
                    }); 
    });

    $('#copy').click(function(){
        $("#short-url").select();
        document.execCommand("copy");
        alert('Copy URL successfully');
    })
</script>
