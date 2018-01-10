var iHotel = iHotel || {};
iHotel.shoppingList = (function ($, ypGlobal) {

    var ajax = YP.ajax, tips = YP.alert, dataList = new YP.list, dataForm = new YP.form, processDataForm = new YP.form;
    var searchButton = $("#searchBtn");

    /**
     * 初始化列表
     */
    function initList() {
        dataList.init({
            colCount: 11,
            autoLoad: true,
            listUrl: ypGlobal.listUrl,
            listDomObject: $("#dataList"),
            searchButtonDomObject: searchButton,
            listTemplate: 'dataList_tpl',
            listSuccess: function (data) {
                dataList.writeListData(data);
            },
            listFail: function (data) {
                tips.show('数据加载失败！');
            }
        });
    }

    /**
     * init task order list modal
     */
    function initEditor() {
        // Init bind function
        var detailModal = $("#editor");
        dataForm.init({
            editorDom: $("#listEditor"),
            saveButtonDom: $("#saveListData"),
            checkParams: eval(ypGlobal.checkParams),
            modelDom: detailModal,
            saveBefore: function (saveParams) {
                dataForm.updateParams({
                    saveUrl: saveParams.id > 0 ? ypGlobal.updateUrl : ypGlobal.createUrl
                });
                saveParams = dataForm.makeRecord(saveParams, saveParams.id, saveParams.titleLang1);
                return saveParams;
            },
            saveSuccess: function (data) {
                dataList.reLoadList();
            },
            saveFail: function (data) {
                tips.show(data.msg);
            }
        });
        // Create task order
        $("#createData").on('click', function () {
            $("#ossfile").html("");
            dataForm.writeEditor({
                editorDom: $("#listEditor"),
                writeData: {count: 1}
            });
        });
    }

    /**
     * init task order process modal
     */
    function initProcessEditor() {
        // 初始化表单保存
        var datatimepickerConfig = {
            language : 'zh-CN',
            format : 'yyyy-mm-dd hh:ii:ss',
            autoclose : true,
            todayBtn : true,
            weekStart : 1,
            minView : 0
        };
        $("#edit_delay").datetimepicker(datatimepickerConfig);
        var detailModal = $("#processEditor");
        processDataForm.init({
            editorDom: $("#processListEditor"),
            saveButtonDom: $("#saveTaskOrderData"),
            checkParams: eval(ypGlobal.checkProcessParams),
            modelDom: detailModal,
            saveBefore: function (saveParams) {
                processDataForm.updateParams({
                    saveUrl: ypGlobal.updateUrl
                });
                saveParams = processDataForm.makeRecord(saveParams, saveParams.id, saveParams.titleLang1);
                return saveParams;
            },
            saveSuccess: function (data) {
                dataList.reLoadList();
            },
            saveFail: function (data) {
                tips.show(data.msg);
            }
        });

        // Edit task order process
        $("#dataList").on('click', 'button[op=editTaskProcess]', function () {
            var $editId = $(this).data('dataid'), $dataDom = $("#dataList").find("[dataId=" + $editId + "]");
            var dataList = {};
            $dataDom.find('td').each(function (key, value) {
                var dataOne = $(value);
                if (dataOne.attr('type')) {
                    dataList[dataOne.attr('type')] = dataOne.data('value');
                }
            });
            processDataForm.writeEditor({
                editorDom: $("#processListEditor"),
                writeData: dataList
            });
            $("#ossfile").html("");
            detailModal.modal('show');
        });
    }

    function init() {
        initList();
        initEditor();
        initProcessEditor();
    }

    return {
        init: init
    };
})(jQuery, YP_GLOBAL_VARS);

$(function () {
    iHotel.shoppingList.init();
})
