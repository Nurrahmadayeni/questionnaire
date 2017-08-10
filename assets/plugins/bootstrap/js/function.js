function confirm_delete() {
  return confirm('Apakah anda yakin ingin menghapus data ini?');
}
function confirm_logout() {
  return confirm('Apakah anda yakin ingin keluar?');
}

function test(obj){
    var html ="";
    var val = $(obj).val();
    if(!$.isNumeric(val)){
        $("#value_ans").html("");

        $(".alert").html("Harus Berupa Angka").fadeIn('slow').delay(1000).fadeOut('slow');
    }
    else if(val<0){
        $("#value_ans").html("");
        $(".alert").html("Harus Lebih Dari 0").fadeIn('slow').delay(1000).fadeOut('slow');

    }else if(val==0){
        $("#value_ans").html("");
        $(".alert").html("Tidak Boleh Sama Dengan 0").fadeIn('slow').delay(1000).fadeOut('slow');            

    }else if(val==1){
        $("#value_ans").html("");
        $(".alert").html("Harus Lebih dari 1").fadeIn('slow').delay(1000).fadeOut('slow');            

    }else if(val>20){
        $("#value_ans").html("");
        $(".alert").html("Tidak Boleh Lebih Dari 20").fadeIn('slow').delay(1000).fadeOut('slow');
    }else{
       
        html += "<div class='col-md-2'>Nilai Pilihan Jawaban</div><div class='col-md-10'>";
        for(i=0 ; i<val ; i++){
            html += "<input type='text' name='value_style_ans[]' class='form-control' placeholder='Input nilai pilihan jawaban' required/><br/>";
        }
        html+="</div>";
        $("#value_ans").html(html);
    }
}
function formAction(url){
    $("#save_add").val('Process . . .');
    $.ajax({
        url: url,
        type:'POST',
        data:$('#form_addQst').serialize(),
        success:function(result){
            $("#save_add").val('Simpan dan Tambah');
            $("#response").html(result);
        }
    });
}
    
$(document).ready(function () {    
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });

    //AnswerQst
    $('#form_question').on('submit', function (event) {
        event.preventDefault();
        $("#submit_answer").val('Process . . .');
        var delay = 1500;
        $.ajax({
            url:'mods/backend/act.php?act=addQst',
            type:'POST',
            data:$('#form_question').serialize(),
            success:function(result){
                $("#submit_answer").val('Submit');  
                $("#alert").fadeIn('slow').html(result);
                $('html, body').animate({ scrollTop: 0 }, 700);
                $( "#alert" ).delay( 500 ).fadeOut( 8000 );

                // console.log(result);
                if(result==" Sukses Jawab Survey"){
                    // var Base64 = {_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9+/=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/rn/g,"n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}}
                    // var srvey = Base64.encode("dashboard_tampilan_home_pengguna");

                    setTimeout(function() {
                      window.history.back();
                    }, 1500);
                    
                }
            }
        });
    });

    // addSurvey
    $('#form_addSurvey').on('submit', function (event) {
        event.preventDefault();
        $("#submit").val('Process . . .');
        var level = $("#level").val();
        var username = $("#username").val();
        var delay = 1500;

        $.ajax({
            url:'mods/backend/act.php?act=addSurvey',
            type:'POST',
            data:$('#form_addSurvey').serialize(),
            success:function(result){
                $("#submit").val('Submit');  
                $("#alert").html(result).fadeIn('slow');
                $('html, body').animate({ scrollTop: 0 }, 700);
                $( "#alert" ).delay( 500 ).fadeOut( 100 );

                console.log(result);
                // alert(result);
                if(result==" Survey Berhasil Ditambah"){
                    // alert(level);

                    var Base64 = {_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9+/=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/rn/g,"n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}}
                    
                    $.post('mods/backend/act.php?act=getMaxSrv',
                        {username:username},
                        function(data){
                            // console.log(data);
                            var max = data.replace(/ /g, '');                           
                            // alert(max);

                            var q = Base64.encode("tambah_question_pengguna_admin");
                            var s = Base64.encode(max);

                            setTimeout(function() {
                              window.location.href = "?d="+q+"&srv="+s;
                            }, 1500);
                        }   
                    );

                }
            }
        });
    });

    // copySurvey
    $('#form_copySurvey').on('submit', function (e) {
        e.preventDefault();
        $("#submit").val('Process . . .');
        var delay = 1500;
        $.ajax({
            url:'mods/backend/act.php?act=copySurvey',
            type:'POST',
            dataType : 'html',
            data:$('#form_copySurvey').serialize(),
            success:function(result){
                $("#submit").val('Submit');  
                $("#alert").fadeIn('slow').html(result);
                $('html, body').animate({ scrollTop: 0 }, 700);
                // $( "#alert" ).delay( 500 ).fadeOut( 1000 );
                
                console.log(result);

                if(result==" Pertanyaan berhasil disalin ke survey baru"){
                    var Base64 = {_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9+/=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/rn/g,"n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}}
                    var srvey = Base64.encode("list_survey_pengguna_admin");

                    setTimeout(function() {
                      window.location.href = "?d="+srvey;
                    }, 1500);

                    // $.post('mods/backend/act.php?act=getMaxSrv',
                    //     function(data){
                    //         var max = data.replace(/ /g, ''); 
                    //         alert(max);
                    //         var Base64 = {_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9+/=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/rn/g,"n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}}
                    //         var quest = Base64.encode("list_question_pengguna_admin");
                    //         var srvey = Base64.encode(max);

                    //         setTimeout(function() {
                    //           window.location.href = "?d="+quest+"&srv="+srvey;
                    //         }, 1500);
                    //     }   
                    // );
                }
            }
        });
    });

    // addQst
    $('#save_add').click(function(e) {
        var $myForm = $('#form_addQst');
        if (!$myForm[0].checkValidity()) {
          $myForm.find(':submit').click();
        }else{
            e.preventDefault();

            $("#save_add").val('Process . . .');
            $.ajax({
                url:'mods/backend/act.php?act=newQstAdd',
                type:'POST',
                data:$('#form_addQst').serialize(),
                success:function(result){
                    $("#save_add").val('Simpan dan Tambah');
                    $('html, body').animate({ scrollTop: 0 }, 700);
                    // $("#response_add").html(result).fadeIn('slow');
                    // $("#response_add").fadeOut(1500);
                    $('#form_addQst').trigger("reset");

                    $.post('mods/backend/act.php?act=jlh_tanya',
                        {id_survey:$("#id_s").val()},
                        function(html){
                            $("#jlh_tanya").html(html);
                        }   
                    );

                    $('#form_tambah_qst').fadeOut('slow');
                    $('#jumlah_skala_ans').empty(); 
                    $('#value_ans').empty(); 
                    $('#form_tambah_qst').fadeIn('slow').delay(2000);                    
                }
            });
        }
        // alert('click');
    });

    $('#save_list').click(function(e) {
        var $myForm = $('#form_addQst');
        if (!$myForm[0].checkValidity()) {
          $myForm.find(':submit').click();
        }else{
            e.preventDefault();
            $("#save_list").val('Process . . .');
            $.ajax({
                url:'mods/backend/act.php?act=newQstAdd',
                type:'POST',
                data:$('#form_addQst').serialize(),
                success:function(result){
                    $("#save_list").val('Simpan dan Lihat Daftar');
                    $("#response_add").fadeIn('slow').html(result);
                    $('html, body').animate({ scrollTop: 0 }, 700);
                    $("#response_add").fadeOut('slow').delay('1500');
                    $('#form_addQst').trigger("reset").fadeOut('slow');

                    var Base64 = {_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9+/=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/rn/g,"n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}}
                    
                    var list = $('#list').val();
                    var ids = $('#ids').val();
                    // alert(list);

                    setTimeout(function() {
                      window.location.href = "?d="+list+"&srv="+ids;
                    }, 1000);

                }
            });
        }        
    });

     // Modal Delete Anything
    $(document).on('click','.delete',function(e){
        e.preventDefault();
        var qst = $(this).data('id');
        var srv = $(this).data('id2');
        $(".modal-body #srv").val(srv);
        $(".modal-body #qst").val(qst);        
    });

    $('#confirm-delete').on('show.bs.modal', function(e) {
        var delay = 1000;
        $(".btn-ok").click(function () {
            $.ajax({
                url:'mods/backend/act.php?act=deleteQst',
                type:'POST',
                data:$('#delQst').serialize(),
                success:function(result){
                    // $(".modal-body").html(result);
                    $("#confirm-delete").modal('hide').fadeOut('fast');
                    $( "#alert" ).fadeIn('slow').delay( 1500 ).fadeOut('slow');
                    setTimeout(function() {
                        $("#response").html(result);
                    }, delay);                    
                },
                error: function(){
                    $( "#alert2" ).fadeIn('slow').delay( 2000 ).fadeOut('slow');
                }
            });
        });
    });

    $(document).on('click','.delete-survey',function(e){
        e.preventDefault();
        var srv = $(this).data('id');
        $(".modal-body #srv").val(srv);
    });

    $('#confirm-delete-survey').on('show.bs.modal', function() {
        var delay = 1000;
        $(".btn-ok").click(function () {
            $.ajax({
                url:'mods/backend/act.php?act=deleteSrv',
                type:'POST',
                data:$('#delSrv').serialize(),
                success:function(result){
                    console.log(result);
                    // $(".modal-body").html(result);
                    $("#confirm-delete-survey").modal('hide').fadeOut('fast');
                    $( "#alert" ).fadeIn('slow').delay( 1500 ).fadeOut(1000);
                    setTimeout(function() {
                        $("#response").html(result);
                    }, delay);                    
                },
                error: function(){
                    $( "#alert" ).fadeIn('slow').delay( 1500 ).fadeOut('slow');
                }
            });
        });
    });

    $(document).on('click','.delete_user',function(e){
        e.preventDefault();
        var id = $(this).data('id');
        $(".modal-body #id").val(id);
    });

    $('#confirm-delete-user').on('show.bs.modal', function(e) {
        var delay = 1000;
        $(".btn-ok").click(function () {
            $.ajax({
                url:'mods/backend/act.php?act=deleteUser',
                type:'POST',
                data:$('#delUser').serialize(),
                success:function(result){
                    // $(".modal-body").html(result);
                    $("#confirm-delete-user").modal('hide').fadeOut('fast');
                }
            });
        });
    });

    $("#confirm-delete").on('hide.bs.modal', function () {
        location.reload();
    });

    $("#confirm-delete-survey").on('hide.bs.modal', function () {
        location.reload();
    });

     $("#confirm-delete-user").on('hide.bs.modal', function () {
        location.reload();
    });

    $(document).on('change','#style_ans',function () {
        var value = $('option:selected', this).val();
        if(value==1){
            var p = '<div class="col-md-2">Jumlah pilihan </div>'
                    +'<div class="col-md-10">'
                    +'<input type="number" name="jumlah_style"'
                    +'class="form-control" placeholder="input nilai jenis jawaban" id="jumlah_style"'
                    +'required/>'
                    +'<span class="alert alert-danger col-md-4 col-md-offset-4" style="display: none !important;">'
                    +'</span></div> ';
            
            $("#jumlah_skala_ans").html(p).fadeIn('slow');    

        }else if(value==2){
            var p = '<div class="col-md-2">Jumlah pilihan </div>'
                    +'<div class="col-md-10">'
                    +'<input type="number" name="jumlah_style"'
                    +'class="form-control" placeholder="input nilai jenis jawaban" id="jumlah_style"'
                    +'required/>'
                    +'<span class="alert alert-danger col-md-4 col-md-offset-4" style="display: none !important;">'
                    +'</span></div> ';

            $("#jumlah_skala_ans").html(p).fadeIn('slow');         

        }else if(value==3 || value==4 || value==5){
            $('#jumlah_skala_ans').fadeOut('slow').empty(); 
            $('#value_ans').fadeOut('slow').empty(); 
            // $("#jumlah_skala_ans").;
            // $("#value_ans").fadeOut();
        }
    });

    $("#jumlah_skala_ans").bind("keyup change","#jumlah_style", function(){ 
        var val = $('#jumlah_style').val();
        var html = " ";        

        if(!$.isNumeric(val)){
            $("#value_ans").html("");

            $(".alert").html("Harus Berupa Angka").fadeIn('slow').delay(1000).fadeOut('slow');
        }else if(val<0){
            $("#value_ans").html("");
            $(".alert").html("Harus Lebih Dari 0").fadeIn('slow').delay(1000).fadeOut('slow');
        }
        else if(val==0){
            $("#value_ans").html("");
            $(".alert").html("Tidak Boleh Sama Dengan 0").fadeIn('slow').delay(1000).fadeOut('slow');            

        }else if(val==1){
            $("#value_ans").html("");
            $(".alert").html("Harus Lebih dari 1").fadeIn('slow').delay(1000).fadeOut('slow');            

        }else if(val>20){
            $("#value_ans").html("");
            $(".alert").html("Tidak Boleh Lebih Dari 20").fadeIn('slow').delay(1000).fadeOut('slow');
        }else{
            html += "<div class='col-md-2'>Nilai Pilihan Jawaban</div><div class='col-md-10'>";
            for(i=0 ; i<val ; i++){
                html += "<input type='text' name='value_style_ans[]' class='form-control' placeholder='Input nilai pilihan jawaban' required/><br/>";
            }
            html+="</div>";
            $("#value_ans").fadeIn('slow').html(html);
        }
    });

    $("input:radio[name=mat_kul]").click(function () {
        if(this.value=='0'){
            $('#sampel').fadeIn('slow'); 
            $('#sampel').show();
            
            $("input[name='sampel[]']").attr("required", "required");
        }else if(this.value=='1'){
            $("#mhs").prop('checked', false);
            $("#dsn").prop('checked', false);
            $("#pgw").prop('checked', false);
            $("input[name='sampel[]']").attr("required",false);   
            $('#sampel').fadeOut('slow');
            $('#sampel').hide();
        }
    });

    $("input:checkbox").click(function () {
        var s = $("input:checkbox:checked").length;
        if(s>0){
            $("input[name='sampel[]']").attr("required",false);  
        }else if(s==0){
            $("input[name='sampel[]']").attr("required", "required");
        }
    });

    $('#jlh_skala').on('change', function() {
        var p = '<label class="control-label">Nama Profile</label>'
            +'<input type="text" name="nama_profile" class="form-control" required=""> <br/>' 
            +'<label class="control-label"> Input Value (dari terendah => tertinggi) </label> ';
        $('#input_profile').html(p);

        for(i = 0; i < $('#jlh_skala').val(); i++){
            var c = '<input type="text" name="value['+i+']" '
                    +'class="form-control" placeholder="input value" required>'
                    +'</br>';
            $('#input_profile').append(c);
        }
    });

    $('#style_survey').on('change', function() {
        $("#btn_export").fadeOut('slow');
        var value = $('option:selected', this).val();
        $.post('mods/backend/show_filter.php',
            {id:value},
            function(html){
                $("#result").html(html);
                $("#btn_export").fadeIn('slow');
            }   
        );

        
        // if(value==1){
        //     // alert('umum');
        //     $("#srv_umum").fadeIn('slow');
        //     $("#btn_export").fadeIn('slow');
        //     $("#survey_matkul").fadeOut('slow').hide();
        //     $("#thn_ajaran").fadeOut('slow').hide();
        // }else if(value==2){
        //     // alert('matakuliah');
        //     $("#survey_matkul").fadeIn('slow');
        //     $("#thn_ajaran").fadeIn('slow');
            
        //     $("#srv_umum").fadeOut('slow');
        //     $("#btn_export").fadeIn('slow');
        // }
    });


    $('#form_addProfileSkala').on('submit', function (event) {
        event.preventDefault();
        $("#submit").val('Process . . .');
        $.ajax({
            url:'mods/backend/act.php?act=newProfSkala',
            type:'POST',
            data:$('#form_addProfileSkala').serialize(),
            success:function(result){
                $("#submit").val('Submit');
                $("#response").html(result);
            }
        });
    });

    // tambah user admin
    $('#form_addUser').on('submit', function (event) {
        event.preventDefault();
        $("#save").val('Process . . .');
        $.ajax({
            url:'mods/backend/act.php?act=addUser',
            type:'POST',
            data:$('#form_addUser').serialize(),
            success:function(result){
                $("#save").val('Save');
                $("#response").html(result).fadeIn('slow').delay( 1500 ).fadeOut('slow');;

                $('#addUser').on('hidden.bs.modal', function () {
                    window.location.reload(true);
                });
            }
        });
    });

    // $('#username_user, #unit_user').on('keyup', function() {
    //     $( "#response" ).fadeOut('slow');
    // });

    // EditProfile
    $(document).on('click','.editProfile',function(e){
        e.preventDefault();
        $("#editProfile").modal('show');
        $.post('mods/backend/act.php?act=editProfile',
            {id:$(this).attr('data-id')},
            function(html){
                $(".modal-body").html(html);
            }   
        );
        $('#editProfile').on('hidden.bs.modal', function () {
            window.location.reload(true);
        });
    });

    // EditQst
    $(document).on('click','.editQst',function(e){
        e.preventDefault();
        $("#editQst").modal('show');
        $.post('mods/backend/act.php?act=editQst',
            {srv:$(this).attr('data-id'), qst: $(this).attr('data-id2')},
            function(html){
                $(".modal-body").html(html);
            }   
        );
    });

    // EditQst
    $(document).on('click','.editUser',function(e){
        e.preventDefault();
        $("#editUser").modal('show');
        $.post('mods/backend/act.php?act=editUser',
            {id:$(this).attr('data-id')},
            function(html){
                $(".modal-body").html(html);
            }   
        );
        // $('#editUser').on('hidden.bs.modal', function () {
        //     window.location.reload(true);
        // });
    });

     // ShowValueChosen
    $(document).on('click','.showChosen',function(e){
        e.preventDefault();
        $("#show_value_chosen").modal('show');
        $.post('mods/backend/act.php?act=showChosen',
            {srv:$(this).attr('data-id'), qst: $(this).attr('data-id2')},
            function(html){
                $(".modal-body").html(html);
            }   
        );
        // $('#editQst').on('hidden.bs.modal', function () {
        //     window.location.reload(true);
        // });
    });

    $('#mata_kuliah').change(function(){
        var id1 = $("#id_user").val();
        var id2 = $("#id_survey").val();
        var id3 = $("#mata_kuliah").val();
        $.ajax({
          url: 'mods/frontend/mhs/show_question.php',
          data: {id_user :id1, id_survey:id2, id_matkul:id3},
          type: 'POST',
          dataType: 'html',
          success: function(result){
            $('#list_question').html(); 
            $('#list_question').html(result).fadeIn('slow'); 
          }
        });
    });

    $('#form_editQst').on( 'submit', function (event) {
        event.preventDefault();
        $("#update_srv").val('Process . . .');
        $.ajax({
            url:'mods/backend/act.php?act=editSrv',
            type:'POST',
            data:$('#form_editQst').serialize(),
            success:function(result){
                $("#update_srv").val('Update');
                $("#response").html(result);
                $("#tittle").val('');
                $("#date").val('');
                // $("#editProfile").modal('hide');
            }
        });
    });

    $(document).on('click','.editProfile',function(e){
        e.preventDefault();
        $("#editProfile").modal('show');
        $.post('mods/backend/act.php?act=editProfile',
            {id:$(this).attr('data-id')},
            function(html){
                $(".modal-body").html(html);
            }   
        );
        $('#editProfile').on('hidden.bs.modal', function () {
            window.location.reload(true);
        });
    });

    $('#form_editSurvey').on( 'submit', function (event) {
        event.preventDefault();
        $("#btnUpdate").val('Process . . .');
        $.ajax({
            url:'mods/backend/act.php?act=editSrvAct',
            type:'POST',
            data:$('#form_editSurvey').serialize(),
            success:function(result){
                $("#btnUpdate").val('Update');
                $("#response").html(result);
                $("#tittle").val('');
                $("#date").val('');
                $("#addSurvey").modal('hide');
            }
        });
    });

    $(document).on('click','.diagram',function(e){
        e.preventDefault();
        $("#diagram").modal('show');
        $.post('mods/frontend/admin/diagram.php',
            {srv:$(this).attr('data-id'),qst:$(this).attr('data-id2')},
            function(html){
                $(".modal-body").html(html);
            }   
        );
    });


    // report survey

    $('#form_report_srv').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url:'mods/backend/act.php?act=cek_survey',
            type:'POST',
            data:$('#form_report_srv').serialize(),
            success:function(result){
                console.log(result);
                if(result==' Laporan'){
                    $("#prev_donwload").modal('show');
                    $("#diagram.modal-body").empty();
                    var id = $("#id_survey").val();
                    var id2 = $("#style_survey").val();
                    // alert(id);
                    $.post('mods/backend/act.php?act=download_pdf',
                        {id_survey:id, style_survey:id2},
                        function(html){
                            $(".modal-body").html(html);
                        }   
                    );
                }
                else{
                    $("#alert").fadeIn('slow').html(result);
                    $( "#alert" ).delay( 500 ).fadeOut( 1000 );
                }
            }
        });
    });

    $('#excel').click(function(e) {
        var $myForm = $('#form_report_srv');
        if (!$myForm[0].checkValidity()) {
          $myForm.find(':submit').click();
        }else{
            e.preventDefault();

            $.ajax({
                url:'mods/backend/download.php',
                type:'POST',
                data:$('#form_report_srv').serialize(),
                success:function(result){
                    $("#alert").fadeIn('slow').html(result);
                    $('html, body').animate({ scrollTop: 0 }, 700);
                }
            });
        }
        // alert('click');
    });

    $('#pdf').click(function(e) {
        var $myForm = $('#form_report_srv');
        if (!$myForm[0].checkValidity()) {
          $myForm.find(':submit').click();
        }else{
            e.preventDefault();
            $.ajax({
                url:'mods/backend/download_pdf.php',
                type:'POST',
                data:$('#form_report_srv').serialize(),
                success:function(result){
                    $("#alert").fadeIn('slow').html(result);
                    $('html, body').animate({ scrollTop: 0 }, 700);
                }
            });
        }
        // alert('click');
    });

});