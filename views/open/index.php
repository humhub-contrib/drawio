<div class="modal-dialog animated fadeIn" style="width:96%">
    <div class="modal-content drawioModal" style="background-color:transparent;">
        <?=
        \humhub\modules\drawio\widgets\EditorWidget::widget([
            'file' => $file,
        ]);
        ?>
    </div>
</div>
<script>
    window.onload = function (evt) {
        setSize();
    }
    window.onresize = function (evt) {
        setSize();
    }
    setSize();

    function setSize() {
        $('.drawioModal').css('height', window.innerHeight - 110 + 'px');
    }
</script>