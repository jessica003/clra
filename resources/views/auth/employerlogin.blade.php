<form action="{{ route('auth.check',['id' => 1]) }}" method="post" autocomplete="off">
 
 @csrf
    <div class="form-group">
       {{-- <label>Email</label> --}}
       <input type="text" class="form-control" name="email" placeholder="Enter email address" value="{{ old('email') }}" autocomplete="false">
       <span class="text-danger">@error('email'){{ $message }} @enderror</span>
    </div>
    <div class="form-group">
       {{-- <label>Password</label> --}}
       <input type="password" class="form-control" name="password" placeholder="Enter password">
       <span class="text-danger">@error('password'){{ $message }} @enderror</span>
    </div>
    <button type="submit" class="btn btn-block btn-primary">Sign In</button>
    <br>
    
 </form>