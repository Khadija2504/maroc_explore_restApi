@extends('layout.app')
@section('main')
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> --}}
    <div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12">
        <div class="relative py-3 sm:max-w-xl sm:mx-auto">
            <div
                class="absolute inset-0 bg-gradient-to-r from-blue-300 to-blue-600 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl">
            </div>
            <div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20">
                <div class="max-w-md mx-auto">
                    <div>
                        <h1 class="text-2xl font-semibold">Login to your account</h1>
                    </div>
                    <form class="divide-y divide-gray-200" id="login_form">
                        <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                            <div class="relative">
                                <input autocomplete="off" id="email" name="email" type="email" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Email address" />
                                <label for="email" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Email Address</label>
                                <span class="error email_err"></span>
                            </div>
                            <div class="relative">
                                <input autocomplete="off" id="password" name="password" type="password" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Password" />
                                <label for="password" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Password</label>
                                <span class="error password_err"></span>
                            </div>
                            <div class="relative">
                                <button type="submit" value="login" class="bg-blue-500 text-white rounded-md px-2 py-1">login</button>
                            </div>
                        </div>
                    </form>
                </div>
                <p class="result"></p>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $("#login_form").submit(function(event){
                event.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: "http://127.0.0.1:8080/api/login",
                    method: "POST",
                    data: formData,
                    success: function(data){
                        $(".error").text("");
                        if(data.seccess == false){
                            $(".result").text(data.msg);
                        } else if(data.seccess == true){
                            // console.log(data);
                            localStorage.setItem("user_token",data.token_type+" "+data.access_token);
                            window.open("/home", "_self");
                        } else{
                            printErrorMsg(data);
                        }
                    }
                });
            });
            function printErrorMsg(msg){
                $(".error").text("");
                $.each(msg, function(key, value){
                    $("."+key+"_err").text(value);
                });
            }
        });
    </script>
@endsection