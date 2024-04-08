@extends('layout.app')
@section('main')
<div class="grid min-h-screen place-items-center">
    <div class="w-11/12 p-12 bg-white sm:w-8/12 md:w-1/2 lg:w-5/12">
        <h1 class="text-xl font-semibold">Update Itinerary</h1>
        <form class="mt-6 updateItineraireForm" id="updateItineraireForm" enctype="multipart/form-data">
            <label for="titre" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Titre</label>
            <input id="titre" type="text" name="titre" placeholder="Titre" autocomplete="off" class="titre block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
            <span class="error titre_err"></span>
            <div class="flex justify-between gap-3">
                <span class="w-1/2">
                    <label for="point_depart" class="block text-xs font-semibold text-gray-600 uppercase">point de depart</label>
                    <select name="point_depart" value="" id="citiesDepartContainer" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required>
    
                    </select>
                    <span class="error point_depart_err"></span>
                </span>
                <span class="w-1/2">
                    <label for="point_arrivee" class="block text-xs font-semibold text-gray-600 uppercase">point d'arrivee</label>
                    <select name="point_arrivee" value="" id="citiesArriveeContainer" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required>
    
                    </select>
                <span class="error point_arrivee_err"></span>
                </span>
                </div>
            <label for="description" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Description</label>
            <input id="description" type="text" name="description" placeholder="Description" autocomplete="off" class="description block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
            <span class="error description_err"></span>
            <label for="date" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Date</label>
            <input id="date" type="date" name="date" placeholder="Date" autocomplete="off" class="date block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
            <span class="error date_err"></span>
            <label for="duree" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Durée par jour</label>
            <input id="duree" type="number" name="duree" placeholder="Durée par jour" autocomplete="off" class="duree block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
            <span class="error duree_err"></span>
            <label for="image" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">L'image de l'itinéraire</label>
            <input type="file" name="image" id="image" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" />
            <span class="error image_err"></span>
            <label for="category" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Catégorie</label>
            <select name="category_id" id="categoriesContainer" class=" categoriesContainer block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required>
            </select>
            <span class="error category_id_err"></span>
            <button type="submit" value="update" class="w-full py-3 mt-6 font-medium tracking-widest text-white uppercase bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">Update</button>
            <p class="flex justify-between inline-block mt-4 text-xs text-gray-500 hover:text-black result"></p>
        </form>
    </div>
</div>
<script>
    $(document).ready(function () {
        $.ajax({
            url: "http://127.0.0.1:8080/api/itineraire/display_details/{{$id}}",
            method: "GET",
            success: function (data) {
                data.itineraire.forEach(function (item) {
                    $("#titre").val(item.titre);
                    $("#description").val(item.description);
                    $("#date").val(item.date);
                    $("#duree").val(item.duree);
                    $("#point_depart").val(item.point_depart);
                    $("#point_arrivee").val(item.point_arrivee);
                    $("#categoriesContainer").val(item.category_id);

                    $(".titre").text(item.titre);
                    $(".description").text(item.description);
                    $(".date").text(item.date);
                    $(".duree").text(item.duree);
                    $(".point_depart").text(item.point_depart);
                    $(".point_arrivee").text(item.point_arrivee);
                    $(".categoriesContainer").text(item.category_id);
                });
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    $(document).ready(function () {

        $('#updateItineraireForm').submit(function (event) {
            event.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "http://127.0.0.1:8080/api/itineraire/update/{{$id}}",
                type: "Put",
                headers: {
                    'Authorization': localStorage.getItem('user_token')
                },
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    console.log(data);
                    if (data.success == true) {
                        $("#update_form")[0].reset();
                        $(".error").text("");
                        $(".result").text(data.msg);
                    } else {
                        console.log('error', data);
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                    // printErrorMsg(data);
                }
            });
        });
    });
    $(document).ready(function(){
        $.ajax({
            url: "http://127.0.0.1:8080/api/itineraire/display_details/" + {{$id}},
            method: "GET",
            success: function(data){
                var citiesDepartContainer = $('#citiesDepartContainer');
                var citiesArriveeContainer = $('#citiesArriveeContainer');
                var categoriesContainer = $('.categoriesContainer');
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
                });
            },
            error: function(data){
                console.log('Error:', data);
            }
        });
    });
</script>
@endsection
