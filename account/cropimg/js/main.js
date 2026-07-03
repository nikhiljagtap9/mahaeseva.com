(function (factory) {
  if (typeof define === 'function' && define.amd) {
    // AMD. Register as anonymous module.
    define(['jquery'], factory);
  } else if (typeof exports === 'object') {
    // Node / CommonJS
    factory(require('jquery'));
  } else {
    // Browser globals.
    factory(jQuery);
  }
})(function ($) {



  'use strict';

  var console = window.console || { log: function () {} };

  function CropAvatar($element) {
    this.$container = $element;

    this.$avatarView = this.$container.find('.avatar-view');
    this.$avatar = this.$avatarView.find('img');
    this.$avatarModal = this.$container.find('#avatar-modal');
    this.$loading = this.$container.find('.loadingmodal');

    this.$avatarForm = this.$avatarModal.find('.avatar-form');
    this.$avatarUpload = this.$avatarForm.find('.avatar-upload');
    this.$avatarSrc = this.$avatarForm.find('.avatar-src');
    this.$avatarData = this.$avatarForm.find('.avatar-data');
    this.$avatarInput = this.$avatarForm.find('.avatar-input');
    this.$avatarSave = this.$avatarForm.find('.avatar-save');
    this.$avatarBtns = this.$avatarForm.find('.avatar-btns');

    this.$avatarWrapper = this.$avatarModal.find('.avatar-wrapper');
    this.$avatarPreview = this.$avatarModal.find('.avatar-preview');

    this.init();
  }

  CropAvatar.prototype = {
    constructor: CropAvatar,

    support: {
      fileList: !!$('<input type="file">').prop('files'),
      blobURLs: !!window.URL && URL.createObjectURL,
      formData: !!window.FormData
    },

    init: function () {
      this.support.datauri = this.support.fileList && this.support.blobURLs;

      if (!this.support.formData) {
        this.initIframe();
      }

      this.initTooltip();
      this.initModal();
      this.addListener();
    },

    addListener: function () {
      this.$avatarView.on('click', $.proxy(this.click, this));
      this.$avatarInput.on('change', $.proxy(this.change, this));
      this.$avatarForm.on('submit', $.proxy(this.submit, this));
      this.$avatarBtns.on('click', $.proxy(this.rotate, this));

    },

    initTooltip: function () {
      this.$avatarView.tooltip({
        placement: 'bottom'
      });
    },

    initModal: function () {
      this.$avatarModal.modal({
        show: false
      });
    },

    initPreview: function () {
      var url = this.$avatar.attr('src');             //path of image which was shown on index page on which user has clicked to change image
      this.$avatarPreview.html('<img src="' + url + '">');   //above image is shown in preview section of cropping popup

    },

    initIframe: function () {
      var target = 'upload-iframe-' + (new Date()).getTime();
      var $iframe = $('<iframe>').attr({
            name: target,
            src: ''
          });
      var _this = this;

      // Ready ifrmae
      $iframe.one('load', function () {

        // respond response
        $iframe.on('load', function () {
          var data;

          try {
            data = $(this).contents().find('body').text();
          } catch (e) {
            console.log(e.message);
          }

          if (data) {
            try {
              data = $.parseJSON(data);
            } catch (e) {
              console.log(e.message);
            }

            _this.submitDone(data);
          } else {
            _this.submitFail('Image upload failed!');
          }

          _this.submitEnd();

        });
      });

      this.$iframe = $iframe;
      this.$avatarForm.attr('target', target).after($iframe.hide());
    },


    click: function () {

        if(edit==0)
        {
             $("#cropped_img_numval").val($('#table-ajax tr').length)
              $("#avatar-modal-label_num").html($('#table-ajax tr').length);
        } else
         {
              $("#cropped_img_numval").val(edit)
             $("#avatar-modal-label_num").html(edit);
         }



      this.$avatarModal.modal('show');
      this.initPreview();
    },

    change: function () {

      var files;
      var file;

      if (this.support.datauri) {
        files = this.$avatarInput.prop('files');

        if (files.length > 0) {
          file = files[0];

          if (this.isImageFile(file)) {
            if (this.url) {
              URL.revokeObjectURL(this.url); // Revoke the old one
            }

            this.url = URL.createObjectURL(file);
            this.startCropper();
          }
        }
      } else {
        file = this.$avatarInput.val();



        if (this.isImageFile(file)) {
          this.syncUpload();
        }
      }

    },

    submit: function () {
      if (!this.$avatarSrc.val() && !this.$avatarInput.val()) {
        return false;
      }

      if (this.support.formData) {
        this.ajaxUpload();
        return false;
      }
    },

    rotate: function (e) {
      var data;

      if (this.active) {
        data = $(e.target).data();

        if (data.method) {
          this.$img.cropper(data.method, data.option);
        }
      }
    },

    isImageFile: function (file) {
      if (file.type) {
        return /^image\/\w+$/.test(file.type);
      } else {
        return /\.(jpg|jpeg|png|gif)$/.test(file);
      }
    },

    startCropper: function () {
      var _this = this;

      if (this.active) {
        this.$img.cropper('replace', this.url);
      } else {
        this.$img = $('<img src="' + this.url + '">');
        this.$avatarWrapper.empty().html(this.$img);
        this.$img.cropper({
          aspectRatio: 1,
          preview: this.$avatarPreview.selector,
          strict: false,
          crop: function (e) {
            var json = [
                  '{"x":' + e.x,
                  '"y":' + e.y,
                  '"height":' + e.height,
                  '"width":' + e.width,
                  '"rotate":' + e.rotate + '}'
                ].join();

            _this.$avatarData.val(json);
          }
        });

        this.active = true;

      }

      this.$avatarModal.on('hidden.bs.modal', function () {  edit=0;   $("#resizepreview").attr('src','cropimg/img/picture.jpg' );       
        _this.$avatarPreview.empty();
        _this.stopCropper();
      });


    },

    stopCropper: function () {
      if (this.active) {
        this.$img.cropper('destroy');
        this.$img.remove();
        this.active = false;
      }
    },

    ajaxUpload: function () {



    if(addingone==1)
    {

       num_of_images=(num_of_images*1+1);
       $("#cropped_img_numconst").val(num_of_images) ;
       $("#cropped_img_num").val('1') ;
       count=num_of_images;
       edit=0;
    }


    if(edit!=0)
    {

      $("#edit_cropped_num").val(edit);
      addingone=0;
    }
    else
    {

      edit=0;
      $("#edit_cropped_num").val(0);
    }

      if($("#cropped_img_numconst").val()==0)
      {
        $("#cropped_img_numconst").val("1");
        num_of_images=1;
      }




      var url = this.$avatarForm.attr('action');
      var data = new FormData(this.$avatarForm[0]);
   //  var data = new FormData($("#fileinfo"));
      var _this = this;
      var progbar=0;
      var percentComplete=0;


      $.ajax(url, {

      xhr: function () {
        var xhr = new window.XMLHttpRequest();
        xhr.upload.addEventListener("progress", function (evt) {
            if (evt.lengthComputable) {
                var percentComplete = evt.loaded / evt.total;
                var per=Math.round(percentComplete*100) ;
                $("#percentage").html(per+'%');
                console.log(percentComplete);
                if(per==90)
                {
                  progbar=1;
                }
                else
                {
                    $('.progress').css({
                    width: percentComplete * 100 + '%'
                     });
                }


            }
        }, false);

        return xhr;
    },


        type: 'post',
        data: data,
        dataType: 'json',
        processData: false,
        contentType: false,

        beforeSend: function () {
               _this.submitStart();
        },

        success: function (data) {
          _this.submitDone(data);

        },

        error: function (XMLHttpRequest, textStatus, errorThrown) {
          _this.submitFail(textStatus || errorThrown);
        },


        complete: function () {

          _this.submitEnd();
           $("#avatar-view").children("img").attr('src', '../img/userprofilepic/'+$("#cropped_img_name").val()+'_'+$("#user").val()+'.png?timestamp=' + new Date().getTime());

          if(edit==0)
          {
            if(count!=1)
            {
              $('#cropped_img_num').val($('#cropped_img_num').val()-1);
            }

          }
          else
          {
              $("#avatar-modal-label").html("Upload Image");
               edit=0;
          }


          if(progbar=1)
          {
                 $('.progress').css({
                    width: '100%'
                     });
                if (percentComplete === 1) {
                    $('.progress').addClass('hide');
                }
                progbar=0;
          }



        }
      });
    },

    syncUpload: function () {
      this.$avatarSave.click();
    },

    submitStart: function () {
      this.$loading.fadeIn();
    },

    submitDone: function (data) {
      console.log(data);

      if ($.isPlainObject(data) && data.state === 200) {
        if (data.result) {
          this.url = data.result;

          if (this.support.datauri || this.uploaded) {
            this.uploaded = false;
            this.cropDone();
          } else {
            this.uploaded = true;
            this.$avatarSrc.val(this.url);
            this.startCropper();
          }

          this.$avatarInput.val('');
        } else if (data.message) {
          this.alert(data.message);
        }
      } else {
        this.alert('Failed to response');
      }
    },

    submitFail: function (msg) {
     // this.alert(msg);
    alert('Some Error ocuured,please try again!')
    },

    submitEnd: function () {

         if($('#todochoice').val()=="resize")
               {

                   var xhr = new XMLHttpRequest();
                      xhr.onreadystatechange = function(ev){
                        if (xhr.readyState == 4 && xhr.status == 200) {
                       if(xhr.responseText)
                       {    //alert("res done")
                           //$('#imagesuploaded_'+imgnum).attr('src',"../../img/user/"+imgname+".png?timestamp=" + new Date().getTime());
                            $("#avatar-view").children("img").attr('src', '../img/userprofilepic/'+imgname+'.png?timestamp=' + new Date().getTime());
                           $('#todochoice').val("crop");
                           $("#resizepreview").attr('src','cropimg/img/picture.jpg' );
                             this.$loading.fadeOut();
                       }
                       }
                      };
                      xhr.open('POST', 'resize/uploadResized.php', true);
                      xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                      var todochoice=$('#todochoice').val();
                      var cropped_img_name=$("#cropped_img_name").val();
                      if(edit==0)
                      var imgnum= $("#user").val();
                      else
                      var imgnum=$("#user").val();
                      var imgname=cropped_img_name+'_'+imgnum;
                      var dataURL=$("#dataURL").val();
                      var data = 'image=' + dataURL +'&todochoice='+todochoice+'&imgname='+imgname;
                      xhr.send(data);
               }






       if(($('#table-ajax tr').length-1)==num_of_images)
          $("#cropped_img_num").val("1");

        $('#cropped_img_num').val('1');
      this.$loading.fadeOut();
      if(edit==0)
      {
              if($('#cropped_img_num').val()==1)
              {
                 this.$avatarModal.modal('hide');
                 this.$avatar.attr('src', '../img/userprofilepic/'+$("#cropped_img_name").val()+'_'+$("#user").val()+'.png');
                  $("#resizepreview").attr('src','cropimg/img/picture.jpg' );
                 count=1;
                 addingone=0;
                 $("#cropped_img_num").val("1");
                // $("#imagesuploaded_div").append( "<img src='cropimg/img/file_add.png' class='addmoreimg' style='cursor:pointer' onclick='addmoreimage()'>");
                // $("#avatar-view").css("display", "none");
                 $(".removebut").css("display","inline");
                 $("#numi").html("Number of Images to be uploaded:"+num_of_images);


              }
              else
              {
                 $("#cropped_img_numval").val( $("#cropped_img_numval").val()*1+1);
                   count=count+1;
                   $("#avatar-modal-label_num").html(count);
                   $("#resizepreview").attr('src','cropimg/img/picture.jpg' );

              }
      }
      else
      {
             $("#avatar-modal-label_num").html(count);
           this.$avatarModal.modal('hide');
            $("#resizepreview").attr('src','cropimg/img/picture.jpg' );
             $('#imagesuploaded_'+imgnum).attr('src',"../../img/userprofilepic/"+imgname+".png?timestamp=" + new Date().getTime());     //show edited img


      }

    },

    cropDone: function ()
    {

                     this.$avatarForm.get(0).reset();
                     this.stopCropper();
                     if(edit==0)
                     {
                        var cropped_img_numval=  $("#cropped_img_numval").val();
                          $("#imagesuploaded_div").children(".addmoreimg").remove();
                         $("#table-ajax").append( "<tr><td>"+cropped_img_numval+"</td><td><img style='width: 25px;position: absolute;background:white;cursor:pointer' onclick='editimg("+cropped_img_numval+")' src='cropimg/img/Pencil-icon.png' id='edit"+cropped_img_numval+"'><img class='imagesuploaded' id='imagesuploaded_"+cropped_img_numval+"' src='cropimg/"+this.url+"?"+Math.random()+"'></td><td><a onclick='removeimg("+cropped_img_numval+")' id='remove"+cropped_img_numval+"' class='removebut' href='javascript:void(0)'>Del</a></td></tr>");
                    }
                    else
                    {
                        $("#imagesuploaded_"+edit).attr('src','cropimg/'+this.url+'?'+Math.random());
                    }



    },

    alert: function (msg) {
      var $alert = [
            '<div class="alert alert-danger avatar-alert alert-dismissable">',
              '<button type="button" class="close" data-dismiss="alert">&times;</button>',
              msg,
            '</div>'
          ].join('');

      this.$avatarUpload.after($alert);
    }
  };

  $(function () {
    return new CropAvatar($('#crop-avatar'));

  });





});
