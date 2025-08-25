<div class="page-loading active">
  <div class="page-loading-inner">
    <div class="page-spinner"></div><span>Loading...</span>
  </div>
</div>

<!-- Page loading scripts -->
<script>
  (function () {
    window.onload = function () {
      const preloader = document.querySelector('.page-loading');
      preloader.classList.remove('active');
      setTimeout(function () {
        preloader.remove();
      }, 1000);
    };
  })();
</script> 