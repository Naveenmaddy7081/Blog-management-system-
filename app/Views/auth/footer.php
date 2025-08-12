<footer class="text-white py-2 mt-auto" style="background-color: #2c003e;">
    <div class="container text-center">
        &copy; <?= date('Y') ?> Blogster. Developed by Naveen Maddheshiya.
    </div>
</footer>
<script src="<?= base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>

<script>

// Hide alert after 3 seconds
setTimeout(() => {
    document.querySelectorAll('.alert').forEach(alert => {
        
        alert.style.display='none';
    });
}, 3000);
</script>




</body>