
window.onload=function(){
    for(var i = 0; i < 24; i++){
        $(".select_hour").append("<option value='"+i+"'>"+i+"</option>");
    }
    for(var i = 0; i < 60; i+=5){
        $(".select_minute").append("<option value='"+i+"'>"+i+"</option>");
    }
    $("#pub_starthour option:first-child").attr("selected","selected");
    $("#pub_endhour option:last-child").attr("selected","selected");
    $("#pub_startminute option:first-child").attr("selected","selected");
    $("#pub_endminute option:last-child").attr("selected","selected");
    var datepickerOption = {
        changeYear:true,
        changeMonth: true,
        closeText:"닫기",
        dateFormat:"yy-mm-dd",
        dayNames:['일요일','월요일','화요일','수요일','목요일','금요일','토요일'],
        dayNamesMin:['일','월','화','수','목','금','토'],
        monthNames:['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
        monthNamesShort:['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
        selectOtherMonths:true,
    }
    $("#pub_startdate").datepicker(datepickerOption);
    $("#pub_enddate").datepicker(datepickerOption);

    $("#pub_startdate").on("change", function(){  //시작 날짜 설정
        console.log("startdate", Date.parse($("#pub_startdate").val()));
        $("#pub_enddate").datepicker("option", "minDate", $("#pub_startdate").val());
    });
    $("#pub_enddate").on("change", function(){    //종료 날짜 설정
        console.log("endtdate", Date.parse($("#pub_enddate").val()));
        $("#pub_startdate").datepicker("option", "maxDate", $("#pub_enddate").val());
    });

    $("#pub_starthour").on("change", function(){  //시작 시각 설정
        if(Date.parse($("#pub_startdate").val()) == Date.parse($("#pub_enddate").val())){
            console.log("ㅎㅎ");
            if(Number($("#pub_starthour option:selected").val()) > Number($("#pub_endhour option:selected").val())){
                alert("공결시작시간은 종료시간 이전이어야 합니다.");
                $("#pub_starthour option").removeAttr('selected');
                $("#pub_endhour option").removeAttr('selected');
                $("#pub_starthour option:eq(0)").attr("selected", "selected");
                $("#pub_endhour option:eq(23)").attr("selected", "selected");
            }
        }
    });
    $("#pub_endhour").on("change", function(){  //종료 시각 설정
        if(Date.parse($("#pub_startdate").val()) == Date.parse($("#pub_enddate").val())){
            if(Number($("#pub_starthour option:selected").val()) > Number($("#pub_endhour option:selected").val())){
                alert("공결시작시간은 종료시간 이전이어야 합니다.");
                $("#pub_starthour option").removeAttr('selected');
                $("#pub_endhour option").removeAttr('selected');
                $("#pub_starthour option:eq(0)").attr("selected", "selected");
                $("#pub_endhour option:eq(23)").attr("selected", "selected");
            }
        }
    });

    $("#pub_startminute").on('change', function() {  //시작 분 설정
        if(Date.parse($("#pub_startdate").val()) == Date.parse($("#pub_enddate").val())){
            if(Number($("#pub_starthour option:selected").val()) == Number($("#pub_endhour option:selected").val())){
                if(Number($("#pub_startminute option:selected").val()) > Number($("#pub_endminute option:selected").val())){
                    alert("공결시작시간은 종료시간 이전이어야 합니다.");
                    $("#pub_startminute option").removeAttr('selected');
                    $("#pub_endminute option").removeAttr('selected');
                    $("#pub_startminute option:eq(0)").attr("selected", "selected");
                    $("#pub_endminute option:eq(11)").attr("selected", "selected");
                }
            }
        }
    });
    $("#pub_endminute").on('change', function() { //종료 분 설정
        if(Date.parse($("#pub_startdate").val()) == Date.parse($("#pub_enddate").val())){
            if(Number($("#pub_starthour option:selected").val()) == Number($("#pub_endhour option:selected").val())){
                if(Number($("#pub_startminute option:selected").val()) > Number($("#pub_endminute option:selected").val())){
                    alert("공결시작시간은 종료시간 이전이어야 합니다.");
                    $("#pub_startminute option").removeAttr('selected');
                    $("#pub_endminute option").removeAttr('selected');
                    $("#pub_startminute option:eq(0)").attr("selected", "selected");
                    $("#pub_endminute option:eq(11)").attr("selected", "selected");
                }
            }
        }
    });

    var filesUploader = document.getElementById("pub_file");
    var fileList = document.getElementById("file_list");
    function fileSelector(files){
        var  li, file, fileInfo;
        fileList.innerHTML = "";
        for(i = 0 ; i< files.length; i++){
            if(filesUploader.files != null){
                var ext = files[i].name.split(".")[1];
                var temp =  ['gif', 'png', 'jpg', 'jpeg', 'GIF', 'PNG', 'JPG', 'JPEG'];
                if(temp.indexOf(ext) > -1){
                    var fReader = new FileReader();
                    fReader.addEventListener("load", function () {
                    }, false);
                    fReader.readAsDataURL(files[i]);
                }else{
                    alert("업로드 가능한 파일형식이 아닙니다.");
                    $("#pub_file").val("");
                    return;
                };
            };
        };
    };
    filesUploader.addEventListener("change",function() {
        fileSelector(this.files);
    }, false);

    var fileTarget = $('#pub_file');
    fileTarget.on('change', function(){  // 값이 변경되면
        if(window.FileReader){  // modern browser
            var filename = "";
            for(var i = 0; i< $(this)[0].files.length; i++){
                //console.log($(this)[0].files);
                filename += "&nbsp;"+$(this)[0].files[i].name+"<br>";
            }
        }
        else {  // old IE
            var filename = $(this).val().split('/').pop().split('\\').pop();  // 파일명만 추출
        }
        // 추출한 파일명 삽입
        $(this).siblings('#file_list').html(filename);
    });
    $("#all_chk").click(function(){
        if($("#all_chk").is(":checked")){
            $("input[type=checkbox]").prop("checked", true);
        }else{
            $("input[type=checkbox]").prop("checked", false);
        }
    });
    $(".pubListTable tbody .list_tr").click(function(){
        if($(this).find("input[type=checkbox]").is(":checked") == false){
            $(this).find("input[type=checkbox]").prop("checked", true);
        }else{
            $(this).find("input[type=checkbox]").prop("checked", false);
        }
    });
};