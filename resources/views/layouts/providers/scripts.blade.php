 <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('provider-assets/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{ asset('provider-assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('provider-assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('provider-assets/js/sb-admin-2.min.js')}}"></script>

  <!-- Page level plugins -->
  <script src="{{ asset('provider-assets/vendor/chart.js/Chart.min.js')}}"></script>

  <!-- Page level custom scripts -->
  <script src="{{ asset('provider-assets/js/demo/chart-area-demo.js')}}"></script>
  <script src="{{ asset('provider-assets/js/demo/chart-pie-demo.js')}}"></script>

  <!-- Page level plugins -->
  <script src="{{ asset('provider-assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('provider-assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

  <!-- Page level custom scripts -->
  <script src="{{ asset('provider-assets/js/demo/datatables-demo.js') }}"></script>

{{-- Rating --}}
<script type="text/javascript">
  $(':radio').change(function() {
  console.log('New star rating: ' + this.value);
});
</script>



{{-- Charts --}}

<script>

    var url = "{{ route('provider.chart') }}";
        var host_id = new Array();
        var Labels = new Array();
        var Prices = new Array();
        $(document).ready(function(){
          $.get(url, function(response){
            response.forEach(function(data){
                Years.push(data.stockYear);
                Labels.push(data.stockName);
                Prices.push(data.stockPrice);
            });
    var myChart = new Chart(ctx, {...});
</script>


{{-- DataTables --}}
<script type="text/javascript">
  
if ( $.fn.dataTable.isDataTable( '#dataTable' ) ) {
    table = $('#').DataTable();
}
else {
    table = $('#dataTable').DataTable( {
       "searching": false,
        "paging": false, 
        "info": false,         
        "lengthChange":false

    } );
}

</script>
