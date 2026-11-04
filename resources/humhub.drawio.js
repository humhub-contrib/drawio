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
            $(window).off(that.messageEvent);
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

        // Unique event name per widget instance, so the handler can be removed on close
        this.messageEvent = 'message.drawio' + this.$.attr('id');
        $(window).off('message.drawio').off(this.messageEvent);

        $(window).on(this.messageEvent, function (e) {
            var frame = $('#drawIOFrame')[0];
            var originalEvent = e.originalEvent;

            // Accept messages only from our own draw.io iframe
            if (!frame || !originalEvent || originalEvent.source !== frame.contentWindow) {
                return;
            }

            var editWindow = frame.contentWindow;
            var data;
            try {
                data = JSON.parse(originalEvent.data);
            } catch (err) {
                return;
            }

            if (!data || typeof data !== 'object') {
                return;
            }

            if (data.event === 'init') {
                if (typeof that.options.fileContent === 'string' && that.options.fileContent !== '') {
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
                }).fail(function () {
                    module.log.error('Could not save the diagram', true);
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
