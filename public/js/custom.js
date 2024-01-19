$("#user_form").on("submit",function(e){
    e.preventDefault();
    $.ajax({
        url : '/user-save',
        data: new FormData(this),
        type: 'post',
        processData:false,
        contentType:false,
        beforeSend:function()
		{
			$(document).find('.error').text('');
		},
        success:function(data){
            if(data.status=='0'){
				$.each(data.error,function(key,value){
					$("."+key+"_err").text(value[0]);
				});
			}else{
                $("#msg").html(data.msg);
                $('#addnewuserdata').DataTable().ajax.reload();
                $('#user_form').trigger("reset");
                $(".box-cr").click();
                setTimeout(function(){
                    $("#useraddtab").modal('hide');
                }, 2000);
                //$('#useraddtab').modal('hide');
               
                
            }
            // alert(data);
        }
    })
});




$("#user_editform").on("submit",function(e){
    e.preventDefault();
    $.ajax({
        url : '/user-save',
        data: new FormData(this),
        type: 'post',
        processData:false,
        contentType:false,
        beforeSend:function()
        {
            $(document).find('.error').text('');
        },
        success:function(data){
            if(data.status=='0'){
                $.each(data.error,function(key,value){
                    $("."+key+"_err").text(value[0]);
                });
            }else{
                // $("#msg").html(data.msg);
                $('#addnewuserdata').DataTable().ajax.reload();
                $('#user_editform').trigger("reset");
                if(data.status==2){
                    $("#msg_edit").html(data.msg_edit);
                }
                
                setTimeout(function(){
                    $("#useredittab").modal('hide');
                }, 2000);
            }
            // alert(data);
        }
    })
});


$(document).on("click",".accesspup",function(){
    var id=$(this).attr('data-id');
    $.ajax({
        url : '/get-access',
        type: 'GET',
        data: {id:id},
        success:function(data){
            // alert("data=>"+ data);
            $(".accesslist").empty();
            $(".accesslist").append(data);
        }
    });
});


$(document).on("click",".useredit",function(){
    var userid=$(this).attr('data-id');
    var username=$(this).attr('data-name');
    var useremail=$(this).attr('data-email');
    var usermobile=$(this).attr('data-mobile');
    var userdesigination=$(this).attr('data-desigination');
    var useraccess=$(this).attr('data-access');
    $("#userid").attr("value",userid);
    $("#username").attr("value",username);
    $("#useremail").attr("value",useremail);
    $("#usermobile").attr("value",usermobile);
    $("#userdesigination").prepend('<option selected>'+userdesigination+'</option>');
    $.ajax({
        url : '/getcatname',
        type:'GET',
        data:{useraccess:useraccess},
        success:function(data){
            // $("#useraccess").prepend('<option selected>'+data+'</option>');
            $(".useraccess1").prepend(data);
            // alert(data);
        }
    });
});

$('input[name="password_confirmation"]').keyup(function(){
    //alert('sddfdf');
    var pass=$("input[name='password']").val();
    var conpass=$("input[name='password_confirmation']").val();
    if(pass==conpass){
        $(".cross").removeClass('fa-circle-xmark');
        $(".cross").addClass('fa-circle-check');
    }else{
        $(".cross").removeClass('fa-circle-check');
        $(".cross").addClass('fa-circle-xmark');
    }
});

// $("input[name='username']").val("Enter Name!");


$(document).on("click",".userpassword",function(){
    var id=$(this).attr('data-id');
    $("#cmsg").empty();
    $("#passwordid").attr("value",id);
});


$("#changepassword_form").on("submit",function(e){
    e.preventDefault();
    $.ajax({
        url : '/changepassword',
        data: new FormData(this),
        type: 'post',
        processData:false,
        contentType:false,
        beforeSend:function()
        {
            $(document).find('.error').text('');
        },
        success:function(data){
            if(data.status=='0'){
                $.each(data.error,function(key,value){
                    $("."+key+"_err").text(value[0]);
                });
            }else{
                $("#cmsg").html(data.cmsg);
                $('#addnewuserdata').DataTable().ajax.reload();
                $('#changepassword_form').trigger("reset");
                setTimeout(function(){
                    $("#changepassword").modal('hide');
                    $("#cmsg").empty();
                }, 2000);
                
            }
            // alert(data);
        }
    })
});



$(document).on("click",".changestatus",function(){
    var table=$(this).attr('data-table');
    var status=$(this).attr('data-value');
    var id=$(this).attr('data-id');
    $.ajax({
        url : '/changestatus',
        type:'GET',
        data:{table:table,status:status,id:id},
        success:function(data){
            alert('Status Change successfully');
            location.reload();
        }
    });
});



$(document).on("click",".delete",function(){
    var id=$(this).attr('data-id');
    var table=$(this).attr('data-table');
    $.ajax({
        url : '/delete',
        type:'GET',
        data:{table:table,id:id},
        success:function(data){
            alert('Delete successfully');
            location.reload();
        }
    });
});







$(document).on("click",".fees_submit__",function(){
    
    var cid=$(this).attr('data-courseID');
    var fees_amount= $("#fees_amount"+cid).val();
    $.ajax({
        url : 'https://www.cromacampus.com/feesupdateapi',
        type:'POST',
        data:{cid:cid,fees_amount:fees_amount},
        success:function(data){
            alert("Fees Update Sucessfully");
            
        }
    });
});



$(document).on("click",".feesedit",function(){
    var cid=$(this).attr('data-courseID');
    $("#fees_amount"+cid).removeAttr('readonly');
    $(".submit"+cid).removeClass('mouseblock');
});




// $("#excel_form").on("submit",function(e){
//     e.preventDefault();
//     $.ajax({
//         url : 'https://course.cromacampus.com/api/savedata',
//         type: 'POST',
//         data:new FormData(this),
//         contentType:false,
//         cache:false,
//         processData:false,
//         success:function(data){
//             console.log(data);
//         }
//     })
// });
