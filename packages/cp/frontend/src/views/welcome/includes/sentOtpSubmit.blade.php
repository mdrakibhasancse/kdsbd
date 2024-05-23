<form method="post" action="{{ route('sendOtpMatchUser')}}" class="">
 @csrf
<div class="row">
    <div class="col-md-6 offset-md-3"> 
        <div class="card">
            <div class="card-body">
            <div class="form-group">
                <label  for="mobile">Name</label>
                <input type="text" id="name" name="name" class="form-control w3-medium" value="{{ old('name')}}" placeholder="Enter name">
            </div>

                
            <button type="submit" class="btn w3-midum btn-block btn-primary btn-first-next py-3">{{ __('Submit') }}</button>
            </div>
        </div>
    </div>
</div>
<form>