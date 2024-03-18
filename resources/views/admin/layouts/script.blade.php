<script type="text/javascript">
    selectBtnThis = null;
	$(function(){
        

		$('.timepicker').flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "h:i K",
            time_24hr: false
        });
		$('.timepicker').removeAttr('readonly',false);
		$('.timepicker').keydown(function(e) {
			e.preventDefault();
		});

		$("*").dblclick(function(e){
		    e.preventDefault();
		    return false;
		});

		$('.table-dt').DataTable({
            "dom": "<'row'<'col-md-6'l><'col-md-6'f>><'row'<'col-md-12't>><'row'<'col-md-6'i><'col-md-6'p>>",
            order : [],
            "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
        });

        $('.table-dt10').DataTable({
            "dom": "<'row'<'col-md-6'l><'col-md-6'f>><'row'<'col-md-12't>><'row'<'col-md-6'i><'col-md-6'p>>",
            order : [],
            "aLengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]],
        });

        $(document).on('click','.btn-delete', function(e){
			if(confirm('Are you sure you want to delete this?')){
				return true;
			}
			return false;
		});

		$(document).on('click','.btn-status', function(e){
			if(confirm('Are you sure you want to change status?')){
				return true;
			}
			return false;
		});

		$(document).on('click','.btn-confirm', function(e){
			if(confirm('Are you sure?')){
				return true;
			}
			return false;
		});

        $(document).on('click','.photo-swipe', function(event){
            var stringAr = $(this).data('photoswipe').split('+');
            var items = [];
            for(var i = 0; i < stringAr.length; i++) { 
                items.push({
                    src     : stringAr[i].split('=')[0], 
                    w       : parseInt(stringAr[i].split('=')[1].split(',')[0]),
                    h       : parseInt(stringAr[i].split('=')[1].split(',')[1])
                });
            }

            myConsole(items);
            var pswpElement = document.querySelectorAll('.pswp')[0];
            var options = {
                // optionName: 'option value'
                // for example:
                shareEl:false,
                index: 0 // start at first slide
            };

            // Initializes and opens PhotoSwipe
            var gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
            gallery.init();
        });

        $.getJSON("{{ url('themes/common-files/cities.json') }}", function(data) {
            cityAutoComplete = [];
            for (var i = 0, len = data.length; i < len; i++) {
                cityAutoComplete.push(data[i].name);
            }
        });
        $( ".city-autocomplete" ).autocomplete({
            source: function(request, response) {
                var results = $.ui.autocomplete.filter(cityAutoComplete, request.term);        
                response(results.slice(0, 10));
            }
        });
        $( ".city-autocomplete" ).attr('autocomplete','none');

		
		
    });

	function getHeightWidthFromUrl(url) {
		_width = 1024;
		_height = 1024;
	    $("<img/>",{
	        load : function(){
	            _width = this.width;
	            _height = this.height;
	            alert(this.width);
	        },
	        src  : url
	    });
	    return {width : _width,height : _height};
	}


	function showAjaxLoader() {
		$('.ajaxLoader').show();
	}

	function hideAjaxLoader() {
		$('.ajaxLoader').hide();
	}

	function isEmail(email) {
	  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	  return regex.test(email);
	}

    function readImageCheckScr(input,id) {
	    if (input.files && input.files[0]) {
	        var FileSize = input.files[0].size / 1024 / 1024; // in MB
	        var extension = input.files[0].name.substring(input.files[0].name.lastIndexOf('.')+1);
	        if (FileSize > 2) {
	            PNOTY("Maxiumum Image Size Is 2 Mb.",'error');
	            input.value = '';
	            return false;
	        }
	        else{
	            if (extension == 'jpg' || extension == 'png' || extension == 'jpeg') {
	                var reader = new FileReader();
	                reader.onload = function (e) {
	                    $("#"+id).attr('src', e.target.result);
	                }
	                reader.readAsDataURL(input.files[0]);
	            }
	            else
	            {
	                PNOTY("Only Allowed '.jpg' OR '.png' OR '.jpeg'",'error');
	                input.value = '';
	                return false;
	            }
	        }
	    }
	}

	function fileExAllowed(input,types) {
        if (input.files && input.files[0]) {
            var FileSize = input.files[0].size / 1024 / 1024; // in MB
            var extension = input.files[0].name.substring(input.files[0].name.lastIndexOf('.')+1);
            if (FileSize > 2) {
                PNOTY("Maxiumum File Size Is 2 Mb.",'error');
                input.value = '';
                return false;
            }else{
                typesAr = types.replaceAll('.','').split(',');
                if (isInArray(typesAr,extension)) {
                    return true;
                }else{
                    PNOTY('Only Allowed '+types+' Extension','error');
                    input.value = '';
                    return false;
                }
            }
        }
    }
    function fileExAllowedVideo(input,types) {
	    if (input.files && input.files[0]) {
	        var FileSize = input.files[0].size / 1024 / 1024; // in MB
	        var extension = input.files[0].name.substring(input.files[0].name.lastIndexOf('.')+1);
	        if (FileSize > 50) {
	            PNOTY("Maxiumum File Size Is 40 Mb.",'error');
	            input.value = '';
	            return false;
	        }else{
	            typesAr = types.replaceAll('.','').split(',');
	            if (isInArray(typesAr,extension)) {
	                return true;
	            }else{
	                PNOTY('Only Allowed '+types+' Extension','error');
	                input.value = '';
	                return false;
	            }
	        }
	    }
	}
    function fileExAllowedVideoSize(input,types,size) {
	    if (input.files && input.files[0]) {
	        var FileSize = input.files[0].size / 1024 / 1024; // in MB
	        var extension = input.files[0].name.substring(input.files[0].name.lastIndexOf('.')+1);
	        if (FileSize > size) {
	            PNOTY("Maxiumum File Size Is "+size+" Mb.",'error');
	            input.value = '';
	            return false;
	        }else{
	            typesAr = types.replaceAll('.','').split(',');
	            if (isInArray(typesAr,extension)) {
	                return true;
	            }else{
	                PNOTY('Only Allowed '+types+' Extension','error');
	                input.value = '';
	                return false;
	            }
	        }
	    }
	}
	function redirectUrl(url = ""){
		window.location = url;
	}
    function isInArray(array, search){
	    return array.indexOf(search) >= 0;
	}

	// for notifications
    function playNotification () {
        createjs.Sound.play("notification");
    }

    function loadSound () {
        createjs.Sound.registerSound("{{ url('web/chatNotification.wav') }}", "notification");
    }

    function requestNotifications() {
        if (!window.Notification) {
            //console.log('Browser does not support notifications.');
        } else {
            // check if permission is already granted
            if (Notification.permission === 'granted') {
                //console.log('Already Allowed');
            } else {
                // request permission from user
                Notification.requestPermission().then(function(p) {
                   if(p === 'granted') {
                       // show notification here
                   } else {
                       //console.log('User blocked notifications.');
                   }
                }).catch(function(err) {
                    console.error(err);
                });
            }
        }
    }

    function getNewNotifications(){
        $.ajax({
            url: "{{ url(CommonHelper::admin('get-notifications')) }}",
            type: "POST",
            data: {
                _token  : "{{ csrf_token() }}"
            },
            dataType: "json",
            success: function (res) {
				
				$('#notificationList li:eq(1)').remove();
                $('#notificationList li:eq(0)').after(res.notificationList);
                $('#notificationCounter').html('0');
                notificationCounter = 0;
                if(res.counter > 0){
                    $('#notiFooter').show();   
                }
            },
            cache: false,
        });
    }

    function checkBackend() {
        $.ajax({
            url: "{{ url(CommonHelper::admin('backend-check')) }}",
            type: "POST",
            data: {
                _token  : "{{ csrf_token() }}",
                lastNotification : lastNotification
            },
            dataType: "json",
            success: function (res) {
                

                if (notificationCounter != res.notification_counter) {
                    playNotification();                  
                }

                if (res.notification_counter > 9) {
                    $('#notificationCounter').html('9+');
                }else{
                    $('#notificationCounter').html(res.notification_counter);
                }

                notificationCounter = res.notification_counter;
                lastNotification    = res.lasNotitId;

                //pushToDesktop(res);
            },
            cache: false,
        });
    }

    function pushToDesktop(res) {
        if (window.Notification && Notification.permission === 'granted') {
            if (res.notificationList.length > 0) {
                $.each(res.notificationList , function(index, val) { 
                    var notify = new Notification(val.title, {
                        body: val.body,
                        icon: '{{ url("/weba/assets/images/logo.png") }}',
                    });
                });
            }
        }
    }

    function hideNotificationBar(){
        $('#notificationList li:eq(0)').after('<li><div style="text-align: center;"><img src="{{ url('admin/images/CommonHelper/loader.svg') }}" /></div></li>');
		$('#notiFooter').hide();    
    }

	function resetNotifications(){
		$('#notificationList').html('');
		$('#notificationList').append('<li><h6>Notifications</h6><label class="label label-danger" id="newNotification" style="display: none;">New</label></li><li id="notiFooter" onclick="redirectUrl()"><div class="media text-center"><div class="media-body"><p class="notification-msg">View All</p></div></div></li>');
	}

    function getTermsByStartups(){
        showAjaxLoader();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ url(CommonHelper::admin('startup/captable/term-get')) }}",
            type: "POST",
            data: {
                _token  : "{{ csrf_token() }}",
                startup : $('#modalAddCCPSTerms input[name=startup]').val()
            },
            dataType: "json",
            success: function (res) {
                $('.modal').modal('hide');
                $('#modalSelectCCPSTerms .list-body').html('');
                $.each(res.list, function(key, value) {
                    item = '<div class="col-12">';
                        item += '<div class="form-radio">';
                            item += '<div class="radio radio-inline">';
                                item += '<label style="cursor: pointer;">';
                                    item += '<input type="radio" name="item" value="'+value.id+'">';
                                    item += '<i class="helper"></i>'+value.name;
                                item += '</label>';
                            item += '</div>';
                        item += '</div>';
                    item += '</div>';
                    $('#modalSelectCCPSTerms .list-body').append(item);
                });

                if(res.list.length == 0){
                    $('#modalSelectCCPSTerms .list-body').html('<div class="col-12 text-center"><h5>No terms found</h5></div>');
                }

                $('#modalSelectCCPSTerms').modal('show');
                hideAjaxLoader();
            },
            cache: false,
        });
    }

	// $(document).ready(function($) {
	// 	loadSound();
	// 	setInterval(function(){
	// 		// checkBackend();
	// 	}, 2000);
	// });
</script>




<script>
    var editor_config = {
        path_absolute : "{{ url('/') }}",
        height: 500,    
        selector: 'textarea.tinymceeditor',
        relative_urls: false,
        plugins: [
              "advlist autolink lists link image charmap print preview hr anchor pagebreak",
              "searchreplace wordcount visualblocks visualchars code fullscreen",
              "insertdatetime media nonbreaking save table directionality",
              "emoticons template paste textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        relative_urls: false,
        file_picker_callback : function(callback, value, meta) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

            var cmsURL = editor_config.path_absolute + '/filemanager?editor=tinymce5';
      
              if (meta.filetype == 'image') {
                cmsURL = cmsURL + "&type=Images";
              } else {
                cmsURL = cmsURL + "&type=Files";
              }

            tinyMCE.activeEditor.windowManager.openUrl({
                url : cmsURL,
                title : 'Gallery',
                width : x * 0.8,
                height : y * 0.8,
                resizable : "yes",
                close_previous : "no",
                onMessage: (api, message) => {
                  callback(message.content);
                  myConsole(message);
                }
            });
        }
    };
    tinymce.init(editor_config);

    var editor_config2 = {
        path_absolute : "{{ url('/') }}",
        height: 500,    
        selector: 'textarea.tinymceeditor-nomedia',
        relative_urls: false,
        plugins: [
              "advlist autolink lists link charmap print preview hr anchor pagebreak",
              "searchreplace wordcount visualblocks visualchars code fullscreen",
              "insertdatetime nonbreaking save table directionality",
              "emoticons template paste textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
        relative_urls: false
    };
    tinymce.init(editor_config2);
</script>