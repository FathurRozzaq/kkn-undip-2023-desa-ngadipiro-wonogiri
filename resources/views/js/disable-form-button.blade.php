<script>
    function checkInput(input) {
        const button = input.parentNode.querySelector('button');
        if (input.value.trim() !== '') {
            button.removeAttribute('disabled');
        } else {
            button.setAttribute('disabled', 'disabled');
        }
    }
</script>