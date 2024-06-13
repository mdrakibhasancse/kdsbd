

     <div class="modal fade" id="myModalLg">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">New User Create</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('admin.userAddNew',['module' => $module]) }}" method="post" class="form-new-user-create">
            <div class="modal-body">
                @csrf    
              <div class="form-group form-group-sm mb-2">
              <label for="" class="mb-1">Full Name</label>
              <input type="text" name="name" placeholder="Full Name" step="any" value="{{ old('name') }}" class="form-control" id="name" required>
              </div>
                      
              <div class="form-group form-group-sm mb-2">
                  <label for="" class="mb-1">Email</label>
                  <input type="email" id="email" name="email" class="form-control" value="{{ old('email')}}" id="email" placeholder="Enter email">
              </div>

              <div class="form-group form-group-sm mb-2">
                  <label for="" class="mb-1">Password</label>
                  <input type="password" id="password" name="password" class="form-control" value="{{ old('password')}}" id="password" placeholder="Enter password" required>
              </div>

            </div>
            <div class="modal-footer justify-content-between">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

  

  