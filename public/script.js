$('#btn-submit').click(function(e){
    e.preventDefault();
    $('#box-url').fadeOut();
    $.ajax({
                    /* the route pointing to the post function */
                    url: "{{secure_url('link/store')}}?url="+$('#url').val(),
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