@extends('components.layout')
@section('content')

  <div class="cotainer">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="flex flex-col justify-center">
                  <h1 class="font-bold text-2xl text-center my-10">Reset Password</h1>

  
                      <form action="/reset-password" method="POST">
                          @csrf
                          <input type="hidden" name="token" value="{{ $token }}">

  
                          <div class="form-group row my-5">
                              <label for="password" class="col-md-4 col-form-label text-md-right font-bold">New password</label>
                              <div class="col-md-6">
                                  <input type="password" id="password" placeholder="Enter new password" class=" my-5 px-5 py-3 border border-gray-400 focus:border-gray-700" name="password" required autofocus>
                                </div>
                            </div>
                            @if ($errors->has('password'))
                                <span class="text-danger text-gray-500">{{ $errors->first('password') }}</span>
                            @endif
  
                          <div class="form-group row my-5">
                              <label for="password-confirm" class="col-md-4 col-form-label text-md-right font-bold my-1">Repeat password</label>
                              <div class="col-md-6">
                                  <input type="password" id="password-confirm" placeholder="Repeat password" class=" my-5 px-5 py-3 border border-gray-400 focus:border-gray-700" name="password_confirmation" required autofocus>
                                </div>
                            </div>
                            @if ($errors->has('password_confirmation'))
                                <span class="text-danger text-gray-500">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                            
                          <div class="col-md-6 offset-md-4 text-center">
                              <button type="submit" class="text-white btn btn-primary border bg-green-400 hover:bg-green-600 px-[5em] py-3 rounded-xl">
                                    SAVE CHANGES
                              </button>
                          </div>
                      </form>
                        
                  </div>
              </div>
          </div>
      </div>
  </div>
</main>


@endsection