@extends('layout.app')
@section('main')
<div class="grid min-h-screen place-items-center">
    <div class="w-11/12 p-12 bg-white sm:w-8/12 md:w-1/2 lg:w-5/12">
        <h1 class="text-xl font-semibold">Create a new itinerary!</h1>
        <form class="mt-6" id="update_form" enctype="multipart/form-data">
            <div id="edit_form"></div>
        </form>
    </div>
  </div>
  <script>
    $(document).ready(function(){
        $('#update_form').submit(function(){
            event.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "http://127.0.0.1:8080/api/itineraire/update/" + {{$id}},
                type: "put",
                headers: {
                    'Authorization': localStorage.getItem('user_token')
                },
                success: function(data){
                    console.log(data);
                    if(data.seccess == true){
                        $("#itinerary_form")[0].reset();
                        $(".error").text("");
                        $(".result").text(data.msg);
                    } else{
                        printErrorMsg(data);
                    }
                },
                error: function(data){
                    console.log('Error:', data);
                }
            });
        });
    });
    $(document).ready(function (){
        $.ajax({
            url: "http://127.0.0.1:8080/api/itineraire/display_details/" + {{$id}},
            method: "GET",
            success: function (data) {
                var itineraireContainer = $('#edit_form');
                data.itineraire.forEach(function (item) {
                    var itinerary = `
                        <label for="titre" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Titre</label>
                        <input id="titre" value="${item.titre}" type="text" name="titre" placeholder="Titre" autocomplete="off" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
                        <span class="error titre_err"></span>
                        <div class="flex justify-between gap-3">
                        <span class="w-1/2">
                            <label for="point_depart" class="block text-xs font-semibold text-gray-600 uppercase">point de depart</label>
                            <select name="point_depart" value="${item.point_depart}" id="citiesDepartContainer" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required>

                            </select>
                            <span class="error point_depart_err"></span>
                        </span>
                        <span class="w-1/2">
                            <label for="point_arrivee" class="block text-xs font-semibold text-gray-600 uppercase">point d'arrivee</label>
                            <select name="point_arrivee" value="${item.point_arrivee}" id="citiesArriveeContainer" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required>

                            </select>
                        <span class="error point_arrivee_err"></span>
                        </span>
                        </div>
                        <label for="description" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">description</label>
                        <input id="description" value="${item.description}" type="text" name="description" placeholder="Description" autocomplete="off" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
                        <span class="error description_err"></span>
                        <label for="date" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Date</label>
                        <input id="date" type="date" name="date" value="${item.date}" placeholder="Date" autocomplete="off" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
                        <span class="error date_err"></span>
                        <label for="duree" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Duree par joure</label>
                        <input id="duree" type="number" value="${item.duree}" name="duree" placeholder="Duree par joure" autocomplete="off" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
                        <span class="error duree_err"></span>
                        <label for="image" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">L'image de l'itineraire</label>
                        <input type="file" name="image" id="image" value="${item.image}" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
                        <span class="error image_err"></span>
                        <label for="category" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Category</label>
                        <select name="category_id" id="categoriesContainer" value="${item.category_id}" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required>
                        </select>
                        <span class="error category_id_err"></span>
                        <button type="submit" value="create" class="w-full py-3 mt-6 font-medium tracking-widest text-white uppercase bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
                        update
                        </button>
                        <p class="flex justify-between inline-block mt-4 text-xs text-gray-500 hover:text-black result"></p>
                    `;
                    itineraireContainer.append(itinerary);
                });
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
    $(document).ready(function(){
        $.ajax({
            url: "http://127.0.0.1:8080/api/itineraire/display_details/" + {{$id}},
            method: "GET",
            success: function(data){
                var citiesDepartContainer = $('#citiesDepartContainer');
                var citiesArriveeContainer = $('#citiesArriveeContainer');
                var categoriesContainer = $('#categoriesContainer');
                data.cities.forEach(function(item) {
                    var cities = `
                        <option value="${item.id}">${item.name}</option>
                    `;
                    citiesArriveeContainer.append(cities);
                });
                data.cities.forEach(function(item) {
                    var cities = `
                        <option value="${item.id}">${item.name}</option>
                    `;
                    citiesDepartContainer.append(cities);
                });
                data.categories.forEach(function(item){
                    var categories = `
                        <option value="${item.id}">${item.name}</option>
                    `;
                    categoriesContainer.append(categories);
                })
            },
            error: function(data){
                console.log('Error:', data);
            }
        });
    });
    
  </script>
@endsection