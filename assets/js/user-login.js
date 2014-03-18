    $(document).ready(function(){
    $("#user_login1").validate({
        onkeyup: true,
        ignore: [],
        rules: {
            email: {
                required:true,
                email:true
            },
            password:{
                required:true
            },
        }
    });

}); 
