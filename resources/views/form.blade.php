<!-- Modal -->
<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
      	<h4 class="modal-title" id="myModalLabel"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
      </div>
      <div class="modal-body">
       <form method="post" data-toogle="validator" >
       	@csrf {{ method_field('POST') }}
         <div class="form-group">
         <input type="hidden" name="id" id="id">
           <label for="exampleInputEmail1">Name</label>
           <input type="text" class="form-control" name="name" id="name" placeholder="Name" required="" autofocus="">
         </div>
         <div class="form-group">
           <label for="exampleInputEmail1">Email </label>
           <input type="email" class="form-control" name="email" id="email" placeholder="Email" required="" autofocus="">
         </div>
         <div class="form-group">
           <label for="exampleInputEmail1">Mobile </label>
           <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Mobile" required="" autofocus="">
         </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="insertbutton"></button>
      </div>
      </form>
    </div>
  </div>
</div>

<!--SIngle data show are here-->
<div class="modal fade" id="single-data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      	<h4 class="modal-title" id="myModalLabel" align="center"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
 
      </div>
      <div class="modal-body">
        <ul class="list-group">
		  <li class="list-group-item">ID: <span class="text-danger" id="single-id"></span></li>
		  <li class="list-group-item">Name: <span class="text-danger" id="single-name"></span> </li>
		  <li class="list-group-item">Email: <span class="text-danger" id="single-email"></span></li>
		  <li class="list-group-item">Mobile: <span class="text-danger" id="single-mobile"></span></li>
		</ul>
    </div>
  </div>
</div>