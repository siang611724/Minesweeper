$("#easy").click(function(){
    var mapData = {
        diffculty:"easy",
        column:9,
        row:9
    };
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },     
        type:'get',
        url:'/wang',
        data:mapData,
        success: function(e){
            console.log(e);
        }
    })
});