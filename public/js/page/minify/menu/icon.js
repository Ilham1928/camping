function getData(){var e=$("#url").val(),n=(e||null)+"/menu/icon";$.ajax({type:"GET",dataType:"json",url:n+"/data",success:function(e){$(".error-message").css("display","none"),200===e.code?$(e.data.data).each(function(e,n){var a='<i class="demo-icon">'+n.menu_icon_unicode+"</i>";$("#tableData tbody").append("<tr><td>"+(parseInt,e+1)+"</td><td>"+n.menu_icon_name+"</td><td>"+n.menu_icon_class+"</td><td>"+a+"</td><td>"+n.menu_icon_brand+'</td><td><button type="button" name="button" class="btn btn-success btn-sm" onclick="edit('+n.menu_icon_id+')">Edit</button>&nbsp<button type="button" name="button" class="btn btn-danger btn-sm" onclick="remove('+n.menu_icon_id+')">Delete</button></td></tr>')}):$("#tableData tbody").empty().append('<tr><td style="text-align:center" colspan="10">No Data Available</td></tr>')},statusCode:{500:function(e){$(".error-message").empty().append(e.responseJSON.message),$(".error-message").css("display","block")}}})}function save(){var e=$("#url").val(),t=(e||null)+"/menu/icon",n={menu_icon_name:$("input[name=menu_icon_name]").val(),menu_icon_class:$("input[name=menu_icon_class]").val(),menu_icon_brand:$("input[name=menu_icon_brand]").val(),menu_icon_unicode:$("input[name=menu_icon_unicode]").val()};$.ajax({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},type:"POST",dataType:"json",url:t+"/save",data:n,success:function(e,n,a){200===e.code?$(window).attr("location",t):($(".error-message").empty().append(e.message),$(".error-message").css("display","block"))},statusCode:{500:function(e){$(".error-message").empty().append(e.responseJSON.message),$(".error-message").css("display","block")}}})}function clearForm(){$(".error-message").css("display","none")}function edit(e){var n=$("#url").val(),a=(n||null)+"/menu/icon";$(window).attr("location",a+"/edit/"+e)}function update(){var e=$("#url").val(),t=(e||null)+"/menu/icon",n=document.getElementById("queue").value,a={menu_icon_id:n,menu_icon_name:$("input[name=menu_icon_name]").val(),menu_icon_class:$("input[name=menu_icon_class]").val(),menu_icon_brand:$("input[name=menu_icon_brand]").val(),menu_icon_unicode:$("input[name=menu_icon_unicode]").val()};$.ajax({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},type:"POST",dataType:"json",url:t+"/update/"+n,data:a,success:function(e,n,a){200===e.code?$(window).attr("location",t):($(".error-message").empty().append(e.message),$(".error-message").css("display","block"))},statusCode:{500:function(e){$(".error-message").empty().append(e.responseJSON.message),$(".error-message").css("display","block")}}})}function remove(e){var n=$("#url").val(),t=(n||null)+"/menu/icon",a={menu_icon_id:e};$.ajax({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},type:"GET",dataType:"json",url:t+"/delete",data:a,success:function(e,n,a){200===e.code?$(window).attr("location",t):($(".error-message").empty().append(e.message),$(".error-message").css("display","block"))}})}