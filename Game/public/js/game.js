$("#easy").click(function(){
    var mapData = {
        column:9,
        row:9,
        bomb:10
    };
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },     
        type:'get',
        url:'/wang/9/9/10',
        success: function(e){
            console.log(e);
        }
    })
});