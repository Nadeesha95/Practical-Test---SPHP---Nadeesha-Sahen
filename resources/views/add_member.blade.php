@extends('layouts.main')
@section('content') 


<div class="container-fluid" style="width: 80%; margin-top: 80px;">


<div class="container py-3">
    <div class="row">

        <div class="mx-auto col-sm-8">
                    <!-- form user info -->
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-0">User Information <a href="/" class="btn btn-danger btn-sm float-end"> BACK</a></h4>
                            
                        </div>
                        <div class="card-body">
                        <form action="{{route('submit-member-details')}}" method="post" enctype="multipart/form-data" id="member_form">
								
                        @csrf
                 <div id="errors"></div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label"> Name</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" name="name" id="name" type="text" value="{{old('name')}}">
                                    </div>
                                </div>
                                <div class="form-group row" style="margin-top: 10px;">
                                    <label class="col-lg-3 col-form-label form-control-label">Email</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" name="email" id="email" type="email" value="{{old('email')}}">
                                    </div>
                                </div>
                                <div class="form-group row" style="margin-top: 10px;">
                                    <label class="col-lg-3 col-form-label form-control-label">Phone</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" name="phone" id="phone"  type="text" value="{{old('phone')}}">
                                    </div>
                                </div>
                                <div class="form-group row" style="margin-top: 10px;">
                                    <label class="col-lg-3 col-form-label form-control-label">Joined date</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" name="joined_date" id="joined_date" type="date" value="{{old('joined_date')}}">
                                    </div>
                                </div>
                                <div class="form-group row" style="margin-top: 10px;">
                                    <label class="col-lg-3 col-form-label form-control-label">Current Role</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" name="role" id="role" type="text" value="{{old('role')}}">
                                    </div>
                                </div>
                                <div class="form-group row" style="margin-top: 10px;">
                                    <label class="col-lg-3  col-form-label form-control-label">Comments</label>
                                    <div class="col-lg-9">
                                        <textarea class="form-control" name="comments" id="comments"  >{{old('comments')}}</textarea>
                                    </div>
                                </div>
                              
                                <div class="form-group row" style="margin-top: 10px;">
                                    <label class="col-lg-3 col-form-label form-control-label"></label>
                                    <div class="col-lg-9">
                                       
                                        <button id="btnadd" type="button" class="btn btn-primary" >Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /form user info -->
        </div>
    </div>
</div>

</div>


<script>

$("#btnadd").click(function () {

var name = $("#name").val();
var email = $("#email").val();
var phone = $("#phone").val();
var joined_date = $("#joined_date").val();
var role = $("#role").val();
var comments = $("#comments").val();
$("#errors").text('');




$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

$.ajax({
	url: '/submit-member-details',
	type: 'POST',
	data: {
            'name': name,
			'email': email,
			'phone': phone,
			'joined_date': joined_date,
			'role': role,
            'comments':comments
			},
	success: function (response) {

    if(response.status==422){


        $.each(response.validate_err, function (key, item) 
          {
            $("#errors").append("<li style='font-size:12px;' class='alert alert-danger'>"+item+"</li>")
          });


    }else{

Swal.fire({
position: 'top-end',
icon: 'success',
title: 'success',
text: response.message,
showConfirmButton: false,
timer: 1500
});

$("#name").val('');
 $("#email").val('');
 $("#phone").val('');
 $("#joined_date").val('');
 $("#role").val('');
 $("#comments").val('');

    }
		



	}
});



});

</script>

@endsection