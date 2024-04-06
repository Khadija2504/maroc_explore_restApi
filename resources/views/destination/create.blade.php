@extends('layout.app')
@section('main')
<div class="grid min-h-screen place-items-center">
    <div class="w-11/12 p-12 bg-white sm:w-8/12 md:w-1/2 lg:w-5/12">
      <h1 class="text-xl font-semibold">Create a new destination!</h1>
      <form class="mt-6" id="destination_form">
        <label for="name" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">name</label>
        <input id="name" type="text" name="name" placeholder="name" autocomplete="off" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
        <span class="error name_err"></span>
        <div class="flex justify-between gap-3">
            <span class="w-full">
                <label for="city_id" class="block text-xs font-semibold text-gray-600 uppercase">City</label>
                <select name="city_id" id="citiesContainer" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required>

                </select>
                <span class="error city_id_err"></span>
            </span>
        </div>
        <label for="toVisit" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">toVisit</label>
        <input id="toVisit" type="text" name="toVisit" placeholder="toVisit" autocomplete="off" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
        <span class="error toVisit_err"></span>
        <label for="activities" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Add the activities list for this destination</label>
        <input id="activities" type="text" name="activities" placeholder="activities" autocomplete="off" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
        <span class="error activities_err"></span>
        <label for="plats" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Les plats disponible </label>
        <input id="plats" type="text" name="plats" placeholder="plats par joure" autocomplete="off" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
        <span class="error plats_err"></span>
        <input name="id_itineraire" id="" type="hidden" value="{{$id}}" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required>
        <button type="submit" value="create" class="w-full py-3 mt-6 font-medium tracking-widest text-white uppercase bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
          Create
        </button>
        <p class="flex justify-between inline-block mt-4 text-xs text-gray-500 hover:text-black result"></p>
      </form>
    </div>
  </div>
  <script>
    $(document).ready(function(){
        $('#destination_form').submit(function(event){
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: "http://127.0.0.1:8080/api/destinations",
                type: "POST",
                headers: {'Authorization': localStorage.getItem('user_token')},
                data: formData,
                success: function(data){
                    $(".error").text("");
                    $(".result").text(data.msg);
                },
                error: function(data){
                    console.log('Error:', data);
                }
            });
        });
    });
    $(document).ready(function(){
        $.ajax({
            url: "http://127.0.0.1:8080/api/itineraire/display",
            method: "GET",
            success: function(data){
                // console.log(data.cities[0].id);
                var citiesContainer = $('#citiesContainer');
                data.cities.forEach(function(item) {
                    var cities = `
                        <option value="${item.id}">${item.name}</option>
                    `;
                    citiesContainer.append(cities);
                });
            },
            error: function(data){
                console.log('Error:', data);
            }
        });
    });

    
  </script>
@endsection