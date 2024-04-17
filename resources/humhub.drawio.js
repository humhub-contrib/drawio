humhub.module('drawio', function (module, require, $) {
    var client = require('client');
    var modal = require('ui.modal');
    var object = require('util').object;
    var Widget = require('ui.widget').Widget;
    var event = require('event');

    var Editor = function (node, options) {
        Widget.call(this, node, options);
    };

    object.inherits(Editor, Widget);

    Editor.prototype.getDefaultOptions = function () {
        return {
            'fileName': 'unnamedFile.drawio',
        };
    };

    Editor.prototype.init = function () {
        this.initEditor();
        this.modal = modal.get('#drawio-modal');
        var that = this;
        this.modal.$.on('hidden.bs.modal', function (evt) {
            that.modal.clear();
        });
    };

    Editor.prototype.close = function (evt) {
        // if save trigger modified event, when file changed
        this.modal.clear();
        this.modal.close();

        if (evt) {
            evt.finish();
        }
    }

    Editor.prototype.initEditor = function () {
        var that = this;

        if (typeof drawioEditorFileGuids === 'undefined') {
            drawioEditorFileGuids = [];
        }
        if (drawioEditorFileGuids.indexOf(that.options.fileGuid) !== -1) {
            // Don't initialize it twice
            return;
        }
        drawioEditorFileGuids.push(that.options.fileGuid);

        $(window).on('message', function (e) {
            if ($('[data-ui-widget="drawio.Editor"]').data('file-guid') !== that.options.fileGuid) {
                // Skip event from editor of another file
                return;
            }

            var editWindow = $('#drawIOFrame')[0].contentWindow;
            var data = JSON.parse(e.originalEvent.data);
            if (data.event === 'init') {
                if (that.options.fileContent != '') {
                    editWindow.postMessage(JSON.stringify({
                        action: "load",
                        xml: that.options.fileContent
                    }), "*");
                } else {
                    editWindow.postMessage(JSON.stringify({
                        action: "template",
                        name: that.options.fileName
                    }), "*");
                }
            } else if (data.event === 'save') {
                // Save Event
                $.ajax({
                    url: that.options.fileSaveUrl,
                    cache: false,
                    type: 'POST',
                    data: {'content': data.xml},
                    dataType: 'json',
                });
            } else if (data.event === 'exit') {
                that.close();
            }
        });
    }


    var init = function (pjax) {};

    var createSubmit = function (evt) {
        client.submit(evt).then(function (response) {
            event.trigger('humhub:file:created', [response.file]);
            m = modal.get('#drawio-modal');
            if (response.openFlag) {
                m.load(response.openUrl);
                m.show();
            } else {
                m.close();
            }

        }).catch(function (e) {
            module.log.error(e, true);
        });
    };

    module.export({
        createSubmit: createSubmit,
        init: init,
        Editor: Editor,
    });

});
