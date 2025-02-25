@extends('layouts.headerSidebar')

@section('title')
    Newsletter
@endsection

@section('content')
    <div class="newsletter-section">
        <div class="row">
            <div class="col-8 offset-2">
                <div class="search-bar mb-3">
                    <form action="" method="GET">
                        <div class="input-group mt-2">
                            <input class="form-control" name="search" placeholder="Id">
                            <input class="form-control" name="search" placeholder="Email">
                            <input class="form-control" name="search" placeholder="Status">
                            <input class="form-control" name="search" placeholder="Keyword">
                            <button type="submit" class="btn btn-outline-success" id="search-btn">Search</button>
                            <button type="button" class="btn btn-outline-danger" id="reset-btn">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-8">
                <div class="heading">
                    <h5>Manage Emails</h5>
                </div>
            </div>
            <div class="col-4">
                <div class="text-end">
                    <a href="#" class="btn btn-success btn-sm">Send Email</a>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <div class="newsletter-body">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Create Time</th>
                                <th scope="col">Email</th>
                                <th scope="col" style="white-space: nowrap">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($emails as $email)
                                <tr>
                                    <th scope="row">{{$email->id ??''}}</th>
                                    <td>{{$email->created_at ??'N/A'}}</td>
                                    <td>{{$email->email ??'N/A'}}</td>
                                    <td>{{$email->status ??'N/A'}}</td>
                                    <td style="white-space: nowrap;">

                                        <a href="#" class="btn btn-outline-success btn-sm"><i class="fa-regular fa-paper-plane"></i></a>
                                        <button type="button" value="{{$email->id}}" class="btn btn-outline-warning editBtn btn-sm"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <a href="#" class="btn btn-outline-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{$emails->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- EDIT MODAL CODE STATR --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Email</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{url('newsletter/update/email')}}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="id">
                <div class="mb-3">
                  <label for="email" class="col-form-label">Email</label>
                  <input type="email" name="email" value="{{old('email')}}" class="form-control" id="email">
                  @error('email') <span class="text-danger">{{$message}}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="status" class="col-form-label">Status</label>
                    <input type="text" name="status" value="{{old('status')}}" class="form-control" id="status">
                    @error('status') <span class="text-danger">{{$message}}</span> @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    {{-- EDIT MODAL CODE END --}}

@endsection

@push('script')
    <script>
        $(document).ready(function () {
            $(document).on('click', '.editBtn', function () {
                var email_id = $(this).val();
                // alert(email_id);
                $('#editModal').modal('show');

                $.ajax({
                    type: "GET",
                    url: "/newsletter/" + email_id + "/email",
                    success: function (response) {
                        // console.log(response.email.id);
                        $('#id').val(email_id);
                        $('#email').val(response.email.email);
                        $('#status').val(response.email.status);
                    }
                });
            });
        });
    </script>
@endpush
