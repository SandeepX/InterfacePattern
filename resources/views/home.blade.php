@extends('layouts.app')

@section('content')

<script>
    $(document).ready(function(){
          $('.edit').click(function () {
              var url = $(this).attr('href');
              $.ajax({
                  type: "put",
                  url: url,
                  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                  success: function (data) {
                      if (data) {
                          $(".alert-message").show();
                          setTimeout(function () {
                                  $(".alert-message").slideUp();
                              }, 5000
                          );
                      }
                  }
              });
          });

              $('.changeStatus').click(function(){
                  var url = $(this).attr('href');
                  var currentRow=$(this).closest("tr");

                 $.ajax({
                      type: "get",
                      url: url,
                      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                      success: function(data)
                      {
                          if(data){

                              const str = data;
                              const str2 = str.charAt(0).toUpperCase() + str.slice(1);

                              if(data === 'active'){
                                  currentRow.find("td:eq(3)").addClass('badge badge-success').removeClass('badge-danger').text(str2);
                              }
                              if(data === 'inactive'){
                                  currentRow.find("td:eq(3)").addClass('badge badge-danger').remove('badge badge-success').text(str2);
                              }
                          }
                      }
              })



          })
    });


</script>

<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('User Create Form') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <div class="bg-red-100 border border-green-400 text-red-700 px-4 py-3 rounded relative alert-message" style="display: none" role="alert">
                            <strong class="font-bold">User Data updated!</strong>
                            <span class="block sm:inline">la thik xa.</span>
                            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                            </span>
                        </div>

                        <div class="w-full max-w-xs">
                            <div>
                                <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="{{route('user-store')}}" method="post">
                                    @csrf
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                            Name
                                        </label>
                                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" name="name" >
                                    </div>

                                    <div class="mb-6">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="password" >
                                            Email
                                        </label>
                                        <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" name="email" >
                                    </div>

                                    <div class="mb-6">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="password" >
                                            Password
                                        </label>
                                        <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" name="password" >
                                    </div>

                                    <button class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded" type="submit">
                                        Create New User
                                    </button>
                                </form>
                            </div>
                        </div>
                </div>

                <div class="card-body">

                        <h1 class="block text-gray-700 text-sm font-bold mb-2 font-bold">
                            Users Listing
                        </h1>
                    <div class="row">
                        <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user as $key => $value)
                                <tr>
                                    <td scope="row" >{{++$key}}</td>
                                    <td>
                                        {{$value->name}}
                                    </td>
                                    <td>
                                        {{$value->email}}
                                    </td>
                                    <td class = "badge badge-{{($value->status=='active') ?'success':'danger'}}">
                                        {{ucfirst($value->status)}}
                                    </td>
                                    <td>
                                        <button class="btn btn-primary edit" href="{{route('user-update',$value->id)}}" type="button"> edit </button>
                                        <button class="btn btn-success changeStatus" value="{{$value->id}}" href="{{route('user-status-change',$value->id)}}" type="button"> change status </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>

            <p class="text-center text-gray-500 text-xs">
                &copy;2021 Phenomenal Sundeep Corp. All rights reserved.
            </p>
            </div>
        </div>
    </div>
</div>
@endsection
