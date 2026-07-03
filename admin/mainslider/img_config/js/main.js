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

    this.$avatardrop = this.$avatarForm.find('#filedrag');

    this.$avatarSave = this.$avatarForm.find('.avatar-save');
    this.$avatarBtns = this.$avatarForm.find('.avatar-btns');
    this.$filedrag = this.$avatarForm.find('#filedrag');

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

     this.$filedrag.on(
    'dragover',
    function(e) {
        e.preventDefault();
        e.stopPropagation();
    }
)
this.$filedrag.on(
    'dragenter',
    function(e) {
        e.preventDefault();
        e.stopPropagation();
    }
)
this.$filedrag.on(
    'drop', $.proxy(this.dropp, this));
/*    function(e){
        if(e.originalEvent.dataTransfer){
            if(e.originalEvent.dataTransfer.files.length) {
                e.preventDefault();
                e.stopPropagation();
                  var files = e.target.files || e.originalEvent.dataTransfer.files;
                   var file = files[0];
                                         alert("lllll")
                             this.url = URL.createObjectURL(file);
                                this.startCropper();

            }
        }
    }
);*/

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
      var url = 'cropimg/img/picture.jpg';             //path of image which was shown on index page on which user has clicked to change image
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


    dropp: function (e) {
          if(e.originalEvent.dataTransfer){
            if(e.originalEvent.dataTransfer.files.length) {
                e.preventDefault();
                e.stopPropagation();


                       if (this.support.datauri) {
                             var files = e.target.files || e.originalEvent.dataTransfer.files;

                            if (files.length > 0) {
                             var file = files[0];

                              if (this.isImageFile(file)) {
                                if (this.url)
                                {
                                  URL.revokeObjectURL(this.url); // Revoke the old one
                                }

                                this.url = URL.createObjectURL(file);
                                this.startCropper();
                                readURL_fordrag(file)  ;
                                $("#dropped").val(1);
                                filesThatWereDropped.push(file);
                              }
                            }
                          } else {
                            file = this.$avatarInput.val();



                            if (this.isImageFile(file)) {
                              this.syncUpload();
                            }
                          }




            }
        }
    },
    click: function () {

         if($("#default_save").val()=="CROP")
         {
         $("#todocrop").prop("checked", true);
         $("#todochoice").val("crop");
         }
         else
         {
         $("#todoresize").prop("checked", true);
         $("#todochoice").val("resize");
         }

      if(edit==0)
      $("#avatar-modal-label_num").html($(".imgdiv").length+1+"/"+$("#img_numm").val());
      else
      $("#avatar-modal-label_num").html(edit+"/"+$("#img_numm").val());
      this.$avatarModal.modal('show');
     // this.initPreview();
    },


    change: function () {    
               if ($('.alert-danger').length > 0)
               {

               }
               else
               {
                          var files;
                          var file;

                          if (this.support.datauri) {
                            files = this.$avatarInput.prop('files');

                            if (files.length > 0) {
                              file = files[0];

                              if (this.isImageFile(file)) {
                                if (this.url)
                                {
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
               }


    },

    submit: function () {

    var f = filesThatWereDropped.pop();
    if($("#dropped").val()==0)
    {
        if (!this.$avatarSrc.val() && !this.$avatarInput.val())
        {
                return false;
        }
    var f = 0;
    }

    if (this.support.formData) {
        this.ajaxUpload(f);
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

      this.$avatarModal.on('hidden.bs.modal', function () {
      if($("#img_upload").val()=="SINGLE")
     {
        if($("#imgdivs .imgdiv").length==1)
        $("#crop-avatar").css("display","none");
     }
     else if($("#img_upload").val()=="MULTI")
     {
         if($("#imgdivs .imgdiv").length==$("#img_numm").val())
         $("#crop-avatar").css("display","none");
     }
     else
     {

     }
     edit=0;
     if ($('.alert-danger').length > 0)
     $(".alert-danger").remove();
       // _this.$avatarPreview.empty();
       // _this.stopCropper();
      });


    },

    stopCropper: function () {
      if (this.active) {
        this.$img.cropper('destroy');
        this.$img.remove();
        this.active = false;
      }
    },

    ajaxUpload: function (f) {

      var url = this.$avatarForm.attr('action');
      var data = new FormData(this.$avatarForm[0]);
      data.append('dragedImage', f);
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
                       {
                             if(edit==0)
                             var n=$("#cropped_img_num").val();
                             else
                             n=edit;
                            $("#img"+n).attr("src",$("#img"+n).attr("src")+"123");

                       }
                       }
                      };
                      xhr.open('POST', 'cropimg/resize/uploadResized.php', true);
                      xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                      var todochoice=$('#todochoice').val();
                      var cropped_img_name=$("#cropped_img_name").val()+"_"+$("#cropped_img_num").val();
                      var imgname=cropped_img_name;
                      var dataURL=$("#dataURL").val();
                      var data = 'image=' + dataURL +'&todochoice='+todochoice+'&imgname='+imgname;
                      xhr.send(data);
               }








      this.$loading.fadeOut();
       this.$avatarModal.modal('hide');
      this.$avatar.attr('src', 'cropimg/img/picture.jpg');
     $("#resizepreview").attr('src','cropimg/img/picture.jpg' );

     var n=$("#cropped_img_num").val();
     if(edit==0)
     $("#imgdivs").append('<div class="imgdiv"><img alt="" class="imgdivclass" id="img'+n+'" src="'+$("#img_ppath").val()+$("#cropped_img_name").val()+'_'+n+'.png?timestamp=' + new Date().getTime()+'" style="width: 200px;border: 1px solid #ccc;border-radius: 10px"><div  class="slim-btn-group"><button data-action="remove" type="button" title="Remove" class="slim-btn slim-btn-remove" onclick="removeimg('+n+')" id="rem'+n+'"><i class="glyphicon glyphicon-remove"></i></button><button id="edit'+n+'" onclick="editimg('+n+')"  data-action="edit" type="button" title="Edit" class="slim-btn slim-btn-edit">Edit</button></div></div>');
     else
      $("#img"+edit).attr("src",$("#img_ppath").val()+$("#cropped_img_name").val()+"_"+edit+".png?timestamp"+ new Date().getTime())


     edit=0;
     

     if($("#img_upload").val()=="SINGLE")
     {
        if($("#imgdivs .imgdiv").length==1)
        $("#crop-avatar").css("display","none");
     }
     else if($("#img_upload").val()=="MULTI")
     {
         if($("#imgdivs .imgdiv").length==$("#img_numm").val())
         $("#crop-avatar").css("display","none");
     }
     else
     {

     }


    },



    cropDone: function ()
    {

                     this.$avatarForm.get(0).reset();
                     this.stopCropper();
                       location.reload();  


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
