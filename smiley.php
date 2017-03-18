<script type="text/javascript" language="javascript">
    function grin(tag) {
        var myField;
        tag = ' ' + tag + ' ';
        if (document.getElementById('comment') && document.getElementById('comment').type == 'textarea') {
            myField = document.getElementById('comment');
        } else {
            return false;
        }
        if (document.selection) {
            myField.focus();
            sel = document.selection.createRange();
            sel.text = tag;
            myField.focus();
        }
        else if (myField.selectionStart || myField.selectionStart == '0') {
            var startPos = myField.selectionStart;
            var endPos = myField.selectionEnd;
            var cursorPos = endPos;
            myField.value = myField.value.substring(0, startPos)
                + tag
                + myField.value.substring(endPos, myField.value.length);
            cursorPos += tag.length;
            myField.focus();
            myField.selectionStart = cursorPos;
            myField.selectionEnd = cursorPos;
        }
        else {
            myField.value += tag;
            myField.focus();
        }
    }
</script>

<?php
    function get_smiley_yimik(){
        global $wpsmiliestrans;
        $smilies ='<p class="yimik-comment-smiles">';
        foreach( array_unique( $wpsmiliestrans ) as $key => $smiley ) {
            $smilies .= '<a href="javascript:grin(\'' . esc_attr($key) . '\')">' . translate_smiley(array($key)) . '</a>';
        }
        $smilies .= '</p>';
        return $smilies;
    }
?>