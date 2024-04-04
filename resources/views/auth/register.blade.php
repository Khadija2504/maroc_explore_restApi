@extends('layout.app')
@section('main')
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> --}}
<div class="h-screen bg-indigo-100 flex justify-center items-center">
	<div class="lg:w-2/5 md:w-1/2 w-2/3">
		<form class="bg-white p-10 rounded-lg shadow-lg min-w-full" id="register_form">
			<h1 class="text-center text-2xl mb-6 text-gray-600 font-bold font-sans">Formregister</h1>
			<div>
				<label class="text-gray-800 font-semibold block my-3 text-md" for="name">name</label>
				<input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="text" name="name" id="name" placeholder="username">
                <span class="error name_err"></span>
            </div>
            <div>
                <label class="text-gray-800 font-semibold block my-3 text-md" for="email">Email</label>
                <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="text" name="email" id="email" placeholder="@email">
                <span class="error email_err"></span>
            </div>
            <div>
                <label class="text-gray-800 font-semibold block my-3 text-md" for="password">Password</label>
                <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="password" name="password" id="password" placeholder="password">
                <span class="error password_err"></span>
            </div>
            <div>
                <label class="text-gray-800 font-semibold block my-3 text-md" for="password_confirmation">Confirm password</label>
                <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="password" name="password_confirmation" id="password_confirmation" placeholder="confirm password">
                <span class="error password_confirmation_err"></span>
            </div>
            <button type="submit" value="register" class="w-full mt-6 bg-indigo-600 rounded-lg px-4 py-2 text-lg text-white tracking-wide font-semibold font-sans">Register</button>
            <a href="/api/login">
                <button class="w-full mt-6 mb-3 bg-indigo-100 rounded-lg px-4 py-2 text-lg text-gray-800 tracking-wide font-semibold font-sans">Login</button>
            </a>
            <p class="result"></p>
		</form>
	</div>
</div>

<script>
    $(document).ready(function(){
        $("#register_form").submit(function(event){
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: "http://127.0.0.1:8080/api/register",
                method: "POST",
                data: formData,
                success: function(data){
                    if(data.msg){
                        $("#register_form")[0].reset();
                        $(".error").text("");
                        $(".result").text(data.msg);
                    } else{
                        printErrorMsg(data);
                    }
                }
            });
        });
        function printErrorMsg(msg){
            $(".error").text("");
            $.each(msg, function(key, value){
                if(key == 'password'){
                    if(value.length > 1){
                    $(".password_err").text(value[0]);
                    $(".password_confirmation_err").text(value[1]);
                    } else{
                        if(value[0].includes('password confirmation')){
                            $(".password_confirmation_err").text(value);
                        } else{
                            $("."+key+"_err").text(value);
                        }
                    }
                } else{
                    $("."+key+"_err").text(value);
                }
            });
        }
    });
</script>
@endsection