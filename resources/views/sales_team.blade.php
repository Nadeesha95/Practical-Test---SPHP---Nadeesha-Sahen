@extends('layouts.main')
@section('content') 


<div class="container-fluid" style="width: 80%; margin-top: 100px;">
 
<div style="display: flex; justify-content: flex-end; margin-bottom: 10px;">
  <a href="{{route('add-new-member')}}"><button class="btn btn-dark">Add New</button> </a>
</div>

<div class="col-lg-12">
<div class="table-responsive"> 
<table class="table table-secondary table-responsive" >
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
      <th scope="col">Currunt Role</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

  @foreach($data as $member)
    <tr>
    <td>{{$member->id}}</td>
    <td>{{$member->name}}</td>
    <td>{{$member->email}}</td>
    <td>{{$member->phone}}</td>
    <td>{{$member->currunt_role}}</td>
    <td>
      <button class="btn btn-sm btn-info viewmember" data-id="{{$member->id}}">View</button>
      <a href="edit-member/{{$member->id}}"><button class="btn btn-sm btn-success">Edit</button></a>
      <a class="delete" data-confirm="Are you sure to delete this item?"  href="delete-member/{{$member->id}}"> <button class="btn btn-sm btn-danger">Delete</button></a>


    </td>

     
    </tr>
    @endforeach
 
  </tbody>
</table>


</div>
</div>


</div>


<!-- Modal -->
<div id="modal1"  class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="background: black; opacity:0.8;">
    <div class="modal-content" >
      <div class="modal-header" style="background: #212529;">
        <h5 class="modal-title" style="color:aliceblue;" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
       
      <table class="table">
  <thead>

  </thead>
  <tbody>
    <tr>
      <th scope="row">ID</th>
      <td id="row_id"></td>

    </tr>

    <tr>
      <th scope="row">Email</th>
      <td id="row_email"></td>

    </tr>

    <tr>
      <th scope="row">Phone</th>
      <td id="row_phone"></td>

    </tr>

    <tr>
      <th scope="row">Joined Date</th>
      <td id="row_joined_date"></td>

    </tr>

    <tr>
      <th scope="row">Curruent Role</th>
      <td id="row_role"></td>

    </tr>

    <tr>
      <th scope="row">Comments</th>
      <td id="row_comments"></td>

    </tr>

  </tbody>
</table>

      </div>
      <div class="modal-footer" style="background: #212529;">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->


<script>

$(document).on('click', '.viewmember', function(){ 
		
	
		var user_id = $(this).attr("data-id");
	
           $.ajax({  
                url:"/view-member/"+user_id+"",  
                method:"GET",    
                dataType:"json",  
                success:function(data)  
                {  
                  if(data.status==200){
                    $('#exampleModalLabel').text(data.data.name);
                    $('#row_id').text(data.data.id);
                    $('#row_email').text(data.data.email);
                    $('#row_phone').text(data.data.phone);
                    $('#row_joined_date').text(data.data.joined_date);
                    $('#row_role').text(data.data.currunt_role);
                    $('#row_comments').text(data.data.comments);
                    $('#modal1').modal('toggle');
                  }else{

                    alert('something went wrong')
                  }
                     
                    //  $('#cor').val(data.course); 
           
                }  
           })  
      }); 


  
  var deleteLinks = document.querySelectorAll('.delete');

for (var i = 0; i < deleteLinks.length; i++) {
  deleteLinks[i].addEventListener('click', function(event) {
      event.preventDefault();

      var choice = confirm(this.getAttribute('data-confirm'));

      if (choice) {
        window.location.href = this.getAttribute('href');
      }
  });
}
</script>



@endsection