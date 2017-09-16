



  // 验证登录表单
  $("#articlesForm").validate({
     
     submitHandler: function(form){
     
  
                $(form).ajaxSubmit({
                    dataType:"json",
                    success:function(res){
                        // res
                        if (res === true) {
                            swal("提交成功", "可在此页面继续操作 :)", "success");
                            window.setTimeout("window.location.reload();",2000);
                        } else if (res === false) {
                            swal("提交失败", "请尝试刷新页面后重试 :(", "error");
                        } else {
                            swal("提交失败", res, "error");
                        }
                    },
                    error:function(e){
                        console.log(e);
                        swal("未知错误", "请尝试刷新页面后重试 :(", "error");
                    }
                });
            }
        
  });
