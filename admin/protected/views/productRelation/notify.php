<script type="text/javascript">
    $(document).ready(function() {
         $('#StatusBar').jnotifyAddMessage({
            text: '<?php echo $notify; ?>',
            permanent: true,
            type: 'error'
        });
    });
</script>

