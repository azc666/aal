<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>AAL Products</title>

  {{-- editor css --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.0/css/select.bootstrap4.min.css">
  <link rel="stylesheet" href="/plugins/editor/css/editor.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

  {{-- addl export buttons css --}}
  {{-- <link rel="stylesheet" href="/plugins/editor/css/editor.dataTables.min.css"> --}}
  <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">



  {{-- js scripts --}}
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
  <script src="{{asset('plugins/editor/js/dataTables.editor.min.js')}}"></script>
  <script src="{{asset('plugins/editor/js/editor.bootstrap4.min.js')}}"></script>

  {{-- export button additions --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>

  <link rel="stylesheet" href="css/main.css">

</head>

<body>

  <div class="container-fluid py-3">
    <h1 align="center">All Access Labs Product Maintenance</h1>
    <a href="../" class="home btn btn-sm btn-primary">Home</a>
    <br>
    <div class="table table-striped table-bordered">
      {{$dataTable->table(['id' => 'products'])}}
    </div>
  </div>

  <script>
    $(document).ready(function() {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': '{{csrf_token()}}'
        }
      });

      var editor = new $.fn.dataTable.Editor({
          ajax: "/products",
          table: "#products",
          // idSrc: 'id',
          display: "bootstrap",
          fields: [
            {label: "UPC:", name: "upc"},
            {label: "Type:", name: "type"},
            {label: "Category:", name: "category"},
            {label: "Product:", name: "product"},
            {label: "Description:", name: "description"},
            {label: "MSRP:", name: "msrp"},
            {label: "Wholesale:", name: "wholesale"},
            {label: "Private Label:", name: "private"},
          ]
      });

      $('#products').on('click', 'tbody td:not(:first-child)', function (e) {
      editor.inline(this);
      });

      $('#product').DataTable( {
      responsive: true,
      dom: "Blfrtip",
      ajax: "product",
      order: [[ 1, 'asc' ]],
      columns: [
        {
          data: null,
          defaultContent: '',
          className: 'select-checkbox',
          orderable: false
        },
        { data: "upc" },
        { data: "type" },
        { data: "category" },
        { data: "product" },
        { data: "description" },
        { data: "msrp",  },
        { data: "wholesale", render: $.fn.dataTable.render.number( ',', '.', 0, '$' ) },
        { data: "private", render: $.fn.dataTable.render.number( ',', '.', 0, '$' ) }
      ],
      select: {
        style: 'os',
        selector: 'td:first-child'
      },

      } );



      {{$dataTable->generateScripts()}}
    })
  </script>

</body>

</html>
