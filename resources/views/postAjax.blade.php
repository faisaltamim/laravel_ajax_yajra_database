<!DOCTYPE html>
<html>
<head>
  <title>Laravel 7 CRUD using Datatables</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
  <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
  <div class="container">
    <br><br>
    <h1 class="text-center">Post data show through ajax yajra datatables</h1>
    <a onclick="addForm()" class="btn btn-sm btn-danger text-white mb-2">Add New</a>
    
    <table id="post-table" class="table table-striped">
      <thead>
        <tr>
          <th width="30">Id</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone No</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        {{-- here data will show from yajra datatables --}}
      </tbody>
    </table>
    {{-- here will be modal form.we can write modal html code in others file .then we have to include that --}}
    @include('form'){{--this form got from form.blade.php file--}}
  </div>
</body>

<script>
  var table1 = $('#post-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ url('posts') }}",
    columns: [
    {data:'id', name:'id'},
    {data:'name', name:'name'},
    {data:'email', name:'email'},
    {data:'mobile', name:'mobile'},
    {data:'action', name:'action', orderable: false, searchable: false}
    ]
  });
  
  // when click add new (posts)
  function addForm() {
    save_method = "add";
    $('input[name=_method]').val('POST');
    $('#modal-form').modal('show');
    $('#modal-form form')[0].reset();
    $('.modal-title').text('Add Post');
    $('#insertbutton').text('Add Post');
  }
  
  //data insert by ajax yajra 
  $(function(){
    $('#modal-form form').on('submit', function (e) {
      if (!e.isDefaultPrevented()){
        var id = $('#id').val();//ei id ta edit er kaaje lage ei id ta modal form e hidden kore rakha ache
        if (save_method == 'add') url = "{{ url('posts') }}";
        else url = "{{ url('posts') . '/' }}" + id;
        $.ajax({
          url : url,
          type : "POST",
          data: new FormData($("#modal-form form")[0]),
          contentType: false,
          processData: false,
          success : function(data) {
            $('#modal-form').modal('hide');
            table1.ajax.reload();
            swal({
              title: "Good job!",
              text: "Data inserted successfully!",
              icon: "success",
              button: "Great!",
            });
          },
          error : function(data){
            swal({
              title: 'Oops...',
              text: data.message,
              type: 'error',
              timer: '1500'
            })
          }
        });
        return false;
      }
    });
  });
  
  
  //edit ajax request are here
  // nicher ei editData function ta paisi amra PostController er index methods e addColumn korsi oikhane edit button dewa ase oikhan theke paisi 
  function editData(id) {
    save_method = 'edit';
    $('input[name=_method]').val('PATCH');
    $('#modal-form form')[0].reset();
    $.ajax({
      url: "{{ url('posts') }}" + '/' + id + "/edit",
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        $('#modal-form').modal('show');
        $('.modal-title').text('Edit Post');
        $('#insertbutton').text('Update Post');
        $('#id').val(data.id);
        $('#name').val(data.name);
        $('#email').val(data.email);
        $('#mobile').val(data.mobile);
      },
      error : function() {
        alert("Nothing Data");
      }
    });
  }  
  
  //delete ajax request as follows
  //nicher delete data function ta PostController er index methods er moddhe addColumn er delete btn theke ashche
  function deleteData(id){
    var csrf_token = $('meta[name="csrf-token"]').attr('content');
    swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover this imaginary file!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url : "{{ url('posts') }}" + '/' + id,
          type : "POST",
          data : {'_method' : 'DELETE', '_token' : csrf_token},
          success : function(data) {
            table1.ajax.reload();
            swal({
              title: "Delete Done!",
              text: "You clicked the button!",
              icon: "success",
              button: "Done",
            });
          },
          error : function () {
            swal({
              title: 'Oops...',
              text: data.message,
              type: 'error',
              timer: '1500'
            })
          }
        });
      } else {
        swal("Your imaginary file is safe!");
      }
    });
  }


   //show single data ajax part here
       function showData(id) {
          $.ajax({
              url: "{{ url('posts') }}" + '/' + id,
              type: "GET",
              dataType: "JSON",
            success: function(data) {
              $('#single-data').modal('show');
              $('.modal-title').text('Details');
              $('#single-id').text(data.id); 
              $('#single-name').text(data.name);
              $('#single-email').text(data.email);
              $('#single-mobile').text(data.mobile);
            },
            error : function() {
                alert("Ghorar DIm");
            }
          });
        }
</script>
</html>