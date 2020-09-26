<footer class="footer footer-fix">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6 footer-copyright">
        <p class="mb-0">Copyright {{date('Y')}} © {{$settings['footer_text_left']}}</p>
      </div>
      <div class="col-md-6">
        <p class="pull-right mb-0"> @php echo  $settings['footer_text_right'] @endphp</p>
      </div>
    </div>
  </div>
</footer>
