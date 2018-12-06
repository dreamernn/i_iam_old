var iHotel = iHotel || {};
iHotel.appRoomPush = (function ($, ypGlobal) {

    var ajax = YP.ajax, tips = YP.alert, pushList = new YP.list, pushForm = new YP.form;

    /**
     * 初始化列表
     */
    function initpushList() {
        $("#filter_dataid").select2({
            placeholder: '全部',
            language: 'zh-CN'
        });
        pushList.init({
            colCount: 7,
            autoLoad: true,
            listUrl: ypGlobal.listUrl,
            listDomObject: $("#dataList"),
            searchButtonDomObject: $("#searchBtn"),
            listTemplate: 'dataList_tpl',
            listSuccess: function (data) {
                pushList.writeListData(data);
            },
            listFail: function (data) {
                tips.show('数据加载失败！');
            }
        });
    }

    /**
     * 初始化编辑新增
     */
    function initEditor() {
        // 初始化表单保存
        var detailModal = $("#editor");
        $("#edit_dataid").select2({
            placeholder: '全部',
            language: 'zh-CN',
            width: 210
        });
        pushForm.init({
            editorDom: $("#listEditor"),
            saveButtonDom: $("#saveListData"),
            checkParams: eval(ypGlobal.checkParams),
            saveUrl: ypGlobal.createBaseUrl,
            modelDom: detailModal,
            saveBefore: function (saveParams) {
                saveParams = pushForm.makeRecord(saveParams, saveParams.id, saveParams.cnTitle);
                return saveParams;
            },
            saveSuccess: function (data) {
                pushList.reLoadList();
            },
            saveFail: function (data) {
                tips.show(data.msg);
            }
        });
        // 新建产品
        $("#createData").on('click', function () {
            pushForm.writeEditor({
                editorDom: $("#listEditor")
            });
        });
    }


    function initTimer() {
        //初始化日期输入框
        var datatimepickerConfig = {
            language: 'zh-CN',
            format: 'yyyy-mm-dd hh:ii',
            autoclose: true,
            todayBtn: true,
            weekStart: 1,
            minView: 1
        };
        $("#edit_time").datetimepicker(datatimepickerConfig);

        var is_timer = $('#edit_timer');
        var editor_time = $('#editor_time');
        if(is_timer.val() == 0){
            editor_time.show();
        } else {
            editor_time.hide();
        }

        is_timer.change(function () {
            var is_timer = $(this);
            var editor_time = $('#editor_time');
            if(is_timer.val() == 0){
                editor_time.show();
            } else {
                editor_time.hide();
            }
        })

    }

    function init() {
        initpushList();
        initEditor();
        initTimer();
    }

    return {
        init: init
    };
})(jQuery, YP_GLOBAL_VARS);

$(function () {
    iHotel.appRoomPush.init();
})
