document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('button').forEach(function(button) {
        button.addEventListener('click', function() {
            this.classList.add('disabled');
            this.textContent = 'Processing...';
        });
    });
});