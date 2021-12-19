  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/js-cookie/js.cookie.js') }}"></script>
  <script src="{{ asset('assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
  <!-- Optional JS -->
  <script src="{{ asset('assets/vendor/chart.js/dist/Chart.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/chart.js/dist/Chart.extension.js') }}"></script>
  <!-- Argon JS -->
  <script src="{{ asset('assets/js/argon.js?v=1.2.0') }}"></script>
  <!-- Modified -->
  <script src="{{ asset('assets/js/components/form-file-input/bs-custom-file-input.js') }}"></script>
  <script src="{{ asset('assets/vendor/select2/4.0.13/js/select2.js') }}"></script>
  <script>
    $(document).ready(() => {
      bsCustomFileInput.init()
      $('.select2').select2({ theme: 'bootstrap4' })
    })
  </script>
  @stack('scripts')
</body>

</html>
