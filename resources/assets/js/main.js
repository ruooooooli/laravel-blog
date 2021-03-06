(function ($) {
    var originTitle = document.title;
    var LaravelBlog = {
        init : function () {
            var self = this;

            $(document).pjax('a:not(a[data-ajax="not"])', '.body', {
                timeout         : 1600,
                maxCacheLength  : 500,
            });

            $(document).on('pjax:start', function () {
                NProgress.configure({ easing: 'ease', speed: 1000 });
                NProgress.start();
            });

            $(document).on('pjax:end', function () {
                NProgress.done();
                self.siteBootUp();
            });

            $(document).on('pjax:complete', function () {
                originTitle = document.title;
                NProgress.done();
                self.resetTitle();
            });

            self.siteBootUp();
        },
        siteBootUp : function () {
            var self = this;

            self.initSemantic();
            self.initBackendLogin();
            self.initSelectDelete();
            self.initDeleteItem();
            self.initCreateUpdateCategory();
            self.initCreateUpdatePost();
            self.initCreateUpdateTag();
            self.initCreateUpdateUser();
            self.initPrefix();
            self.initMarked();
            self.initUploadImage();
        },
        initPrefix : function () {
            $('.come-back').on('click', function () {
                window.history.back();
            });
        },
        resetTitle : function () {
            document.title = originTitle;
        },
        initSemantic : function () {
            $('.ui.dropdown').dropdown();
            $('.menu .item').tab();

            $('.list .master.checkbox').checkbox({
                onChecked : function () {
                    var $childCheckbox = $(this).closest('.list').find('.checkbox');
                    $childCheckbox.checkbox('check');
                },
                onUnchecked : function () {
                    var $childCheckbox = $(this).closest('.list').find('.checkbox');
                    $childCheckbox.checkbox('uncheck');
                }
            });

            $('.list .child.checkbox').checkbox({
                fireOnInit : true,
                onChange   : function () {
                    var $listGroup      = $(this).closest('tbody');
                    var $parentCheckbox = $listGroup.closest('table').find('.master.checkbox');
                    var $checkbox       = $listGroup.find('.checkbox');
                    var allChecked      = true;
                    var allUnchecked    = true;

                    $checkbox.each(function () {
                        if ($(this).checkbox('is checked')) {
                            allUnchecked = false;
                        } else {
                            allChecked = false;
                        }
                    });

                    if (allChecked) {
                        $parentCheckbox.checkbox('set checked');
                    } else if (allUnchecked) {
                        $parentCheckbox.checkbox('set unchecked');
                    } else {
                        $parentCheckbox.checkbox('set indeterminate');
                    }
                }
            });
        },
        initBackendLogin : function () {
            var self = this;

            $('#login-button').on('click', function () {
                var that        = $(this);
                var login       = $.trim($('#login').val());
                var password    = $.trim($('#password').val());

                if (login == '') {
                    swal({
                        title   : '请输入登录的用户名!',
                        type    : 'warning',
                    });

                    return false;
                }

                if (password == '') {
                    swal({
                        title   : '请输入登录的密码!',
                        type    : 'warning',
                    });

                    return false;
                }

                self.submitForm(that);
            });
        },
        initCreateUpdateCategory : function () {
            var self = this;

            $('.create-update-category-btn').on('click', function () {
                var that = $(this);
                var name = $.trim($('#name').val());
                var sort = $.trim($('#sort').val());

                if (name == '') {
                    swal({
                        title   : '请输入分类名称!',
                        type    : 'warning',
                    });

                    return false;
                }

                self.submitForm(that);
            });
        },
        initSelectDelete : function () {
            $('.select-delete-btn').on('click', function () {
                var deleteIds = new Array();
                var deleteUrl = $(this).data('url');

                $('tbody').find('.checkbox').each(function () {
                    if ($(this).checkbox('is checked')) {
                        deleteIds.push($(this).data('id'));
                    }
                });

                if (deleteIds.length == 0) {
                    swal({
                        title   : '请选择要删除的项目!',
                        type    : 'warning',
                    });

                    return false;
                }

                swal({
                    title : "确定要删除所选的项目吗?",
                    type : "warning",
                    showCancelButton : true,
                    confirmButtonColor : "#FF4949",
                    confirmButtonText : "删除",
                    cancelButtonText : "取消",
                    closeOnConfirm : false,
                    closeOnCancel : true
                }, function(isConfirm) {
                    if (isConfirm) {
                        $.post(deleteUrl, {
                            '_method'   : 'DELETE',
                            'idstring'  : deleteIds.join(),
                            '_token'    : Config.token,
                        }, function (response) {
                            if (response.code == 'success') {
                                swal({
                                    'title'  : response.message,
                                    'type'  : 'success',
                                }, function () {
                                    $.pjax.reload('body');
                                });
                            } else {
                                swal({
                                    title   : response.message,
                                    type    : 'warning',
                                });
                            }
                        }, 'json');
                    }
                });
            });
        },
        initCreateUpdateTag : function () {
            var self = this;

            $('.create-update-tag-btn').on('click', function () {
                var that = $(this);
                var name = $.trim($('#name').val());

                if (name == '') {
                    swal({
                        title   : '请输入标签名称!',
                        type    : 'warning',
                    });

                    return false;
                }

                self.submitForm(that);
            });
        },
        initCreateUpdateUser : function () {
            var self = this;

            $('.create-update-user-btn').on('click', function () {
                var that            = $(this);
                var username        = $.trim($('#username').val());
                var email           = $.trim($('#email').val());
                var password        = $.trim($('#password').val());
                var passwordConfirm = $.trim($('#password_confirmation').val());

                if (username == '') {
                    swal({
                        title   : '请输入用户名!',
                        type    : 'warning',
                    });
                    return false;
                }

                if (email == '') {
                    swal({
                        title   : '请输入邮箱地址!',
                        type    : 'warning',
                    });

                    return false;
                }

                if (password != '') {
                    if (passwordConfirm == '') {
                        swal({
                            title   : '请输入确认密码!',
                            type    : 'warning',
                        });

                        return false;
                    }

                    if (passwordConfirm != password) {
                        swal({
                            title   : '请保持确认两次输入密码一致!',
                            type    : 'warning',
                        });

                        return false;
                    }
                }

                self.submitForm(that);
            });
        },
        initCreateUpdatePost : function () {
            var self = this;

            $('.create-update-post-btn').on('click', function () {
                var that        = $(this);
                var title       = $.trim($('#title').val());
                var cid         = $.trim($('#category_id').val());
                var markdown    = $.trim($('#markdown-source').val());

                if (title == '') {
                    swal({
                        title   : '请输入文章标题!',
                        type    : 'warning',
                    });
                    return false;
                }

                if (cid == '') {
                    swal({
                        title   : '请选择文章分类!',
                        type    : 'warning',
                    });

                    return false;
                }

                if (markdown == '') {
                    swal({
                        title   : '请输入文章内容!',
                        type    : 'warning',
                    });

                    return false;
                }

                self.submitForm(that);
            });
        },
        initUploadImage : function () {
            var self = this;
            $('#uploadfile').on('change', function () {
                $(this).closest('form').ajaxSubmit({
                    'url'           : Config.routes.upload_file,
                    'dataType'      : 'json',
                    'type'          : 'POST',
                    'beforeSubmit'  : function () {
                        $('#upload-file-progress').progress({'percent': 0});
                    },
                    'uploadProgress': function (event, position, total, percent) {
                        $('#upload-file-progress').progress({'percent': percent});
                    },
                    'success'       : function (response) {
                        if (response.code == 'success') {
                            self.insertIntoPost('markdown-source', response.data.markdownPath);
                        } else {
                            swal({
                                title   : response.message,
                                type    : 'warning',
                            });
                        }
                    }
                });
            });
        },
        initDeleteItem : function () {
            $('.delete-btn').on('click', function () {
                var that = $(this);

                swal({
                    title : "确定要删除这个项目吗?",
                    type : "warning",
                    showCancelButton : true,
                    confirmButtonColor : "#FF4949",
                    confirmButtonText : "删除",
                    cancelButtonText : "取消",
                    closeOnConfirm : false,
                    closeOnCancel : true
                }, function(isConfirm) {
                    if (isConfirm) {
                        $.post(that.data('url'), {
                            '_method'   : 'DELETE',
                            '_token'    : Config.token,
                        }, function (response) {
                            if (response.code == 'success') {
                                swal({
                                    'title'  : response.message,
                                    'type'  : 'success',
                                }, function () {
                                    $.pjax.reload('body');
                                });
                            } else {
                                swal({
                                    title   : response.message,
                                    type    : 'warning',
                                });
                            }
                        }, 'json');
                    }
                });
            });
        },
        insertIntoPost : function (id, str) {
            var obj             = document.getElementById(id);
            var startPos        = obj.selectionStart;
            var endPos          = obj.selectionEnd;
            var cursorPos       = startPos;
            var tempString      = obj.value;
            obj.value           = tempString.substring(0, startPos) + str + tempString.substring(endPos, tempString.length);
            cursorPos           = cursorPos + str.length;
            obj.selectionStart  = obj.selectionEnd = cursorPos;
        },
        initMarked : function () {
            var self = this;

            $('#markdown-view-tab').on('click', function () {
                self.markDownToHtml();
            });
        },
        markDownToHtml : function () {
            var markdown = $('#markdown-source').val();

            if (markdown != '') {
                marked(markdown, function (error, content) {
                    $('#markdown-html').html(content);
                });
            }
        },
        submitForm : function (that) {
            if (!that.hasClass('loading')) {
                that.addClass('loading').addClass('disabled');
            }

            that.closest('form').ajaxSubmit({
                dataType    : 'json',
                success     : function (response) {
                    if (response.code == 'success') {
                        window.location.href = that.data('url');
                    } else {
                        that.removeClass('loading').removeClass('disabled');
                        swal({
                            title   : response.message,
                            type    : 'warning',
                        });
                    }
                }
            });
        },
    };

    window.LaravelBlog = LaravelBlog;
})(jQuery);

jQuery(document).ready(function($) {
    LaravelBlog.init();
});
