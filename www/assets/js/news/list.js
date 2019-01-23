var iHotel = iHotel || {};
iHotel.newsList = (function ($, ypGlobal) {

    var ajax = YP.ajax, tips = YP.alert, newsList = new YP.list, newsForm = new YP.form;
    var searchButton = $("#searchBtn");

    /**
     * 初始化列表
     */
    function initList() {
        $("#filter_tag").select2({
            placeholder: '全部',
            language: 'zh-CN'
        });
        newsList.init({
            colCount: 11,
            autoLoad: true,
            listUrl: ypGlobal.listUrl,
            listDomObject: $("#dataList"),
            searchButtonDomObject: searchButton,
            listTemplate: 'dataList_tpl',
            listSuccess: function (data) {
                newsList.writeListData(data);
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
        $("#edit_tagid").select2({
            placeholder: '全部',
            language: 'zh-CN',
            width: 210
        });
         // 初始化时间控件
         var datatimepickerConfig = {
            language : 'zh-CN',
            format : 'yyyy-mm-dd hh:ii:ss',
            autoclose : true,
            todayBtn : true,
            weekStart : 1,
            minView : 0,
            startDate: new Date()
        };
        $("#edit_startTime,#edit_endTime").datetimepicker(datatimepickerConfig);

        newsForm.init({
            editorDom: $("#listEditor"),
            saveButtonDom: $("#saveListData"),
            checkParams: eval(ypGlobal.checkParams),
            modelDom: detailModal,
            saveBefore: function (saveParams) {
                newsForm.updateParams({
                    saveUrl: saveParams.id > 0 ? ypGlobal.updateUrl : ypGlobal.createUrl
                });
                //是否首页展示
                if($("#edit_homeShow").is(":checked")){
                    saveParams.homeShow = 1;
                }
                
                saveParams = newsForm.makeRecord(saveParams, saveParams.id, saveParams.titleLang1);
                return saveParams;
            },
            saveSuccess: function (data) {
                newsList.reLoadList();
            },
            saveFail: function (data) {
                tips.show(data.msg);
            }
        });
        // 新建产品
        $("#createData").on('click', function () {
            $("#ossfile").html("");
            $("#listEditor").find('img.deleteFile').each(function (key, value) {
                var element = $(value);
                fileReset(element);
            });
            newsForm.writeEditor({
                editorDom: $("#listEditor")
            });
        });
        // 编辑产品
        $("#dataList").on('click', 'button[op=editDataOne]', function () {
            var $editId = $(this).data('dataid'), $dataDom = $("#dataList").find("[dataId=" + $editId + "]");
            var dataList = {};
            $dataDom.find('td').each(function (key, value) {
                var dataOne = $(value);
                if (dataOne.attr('type')) {
                    dataList[dataOne.attr('type')] = dataOne.data('value');
                }
            });
            $("#listEditor").find('img.deleteFile').each(function (key, value) {
                var element = $(value);
                fileReset(element);
            });
            newsForm.writeEditor({
                editorDom: $("#listEditor"),
                writeData: dataList
            });
            $("#ossfile").html("");
            detailModal.modal('show');
        });
    }

    function initArticleEditor() {
        $("#dataList").on('click', 'button[op=editArticle]', function () {
            window.open('/article/editor?dataid=' + $(this).data('dataid') + '&datatype=' + $(this).data('type') + '&article=' + $(this).data('article'));
        });
    }

    function init() {
        initList();
        initEditor();
        initArticleEditor();
    }

    return {
        init: init
    };
})(jQuery, YP_GLOBAL_VARS);

$(function () {
    iHotel.newsList.init();
})
