var url = 'http://proyecto-laravel.com.devel';
window.addEventListener("load", function(){
    $('btn-like').css('cursor','pointer');
    $('btn-dislike').css('cursor','pointer');
    //Boton de like
    function like(){
        $('.btn-like').unbind('click').click(function(){
            //Boton de like
            $(this).addClass('btn-dislike').removeClass('btn-like');
            $(this).attr('src',url+'/img/corazonRojo.png')
            dislike();
            $.ajax({
                url:url+"/like/"+$(this).data('id'),
                type:'GET',
                success:function(response){
                    if(response.like){
                        console.log('has dado like');
                    }else{
                        console.log('error al dar like')
                    }
                    
                }
            })
        })
    }
    like();
    function dislike(){
        $('.btn-dislike').unbind('click').click(function(){
            //Boton de dislike
            $(this).addClass('btn-like').removeClass('btn-dislike');
            $(this).attr('src',url+'/img/corazonGris.png')
            $.ajax({
                url:url+"/dislike/"+$(this).data('id'),
                type:'GET',
                success:function(response){
                    if(response.like){
                        console.log('has dado dislike');
                    }else{
                        console.log('error al dar dislike')
                    }
                    
                }
            })
            like();
        })
    }
    dislike();
});

