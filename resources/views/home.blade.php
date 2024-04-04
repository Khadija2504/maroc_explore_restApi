@extends('layout.app')
@section('main')
<div class="flex justify-center">
    <div class="py-6 grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3" id="itineraireContainer">
    </div>
</div>
    <script>
        $(document).ready(function(){
            $.ajax({
                url: "http://127.0.0.1:8080/api/itineraire/display",
                method: "GET",
                success: function(data){
                    var itineraireContainer = $('#itineraireContainer');
                    data.itineraire.forEach(function(item) {
                        var itinerary = `
                            <div class="flex max-w-md mb-12 m-6 bg-white shadow-lg rounded-lg overflow-hidden">
                                <div class="w-1/3 bg-cover" style="background-image: url('')"></div> 
                                <div class="w-2/3 p-4">
                                    <h1 class="text-gray-900 font-bold text-2xl titre">${item.titre}</h1>
                                    <p class="mt-2 text-gray-600 text-sm description">${item.description}</p>
                                    <div class="flex item-center mt-2">
                                     duree: ${item.duree}
                                    </div>
                                    <div class="flex item-center justify-between mt-3">
                                        <h1 class="text-gray-700 font-bold text-xl">${item.category.name}</h1>
                                        <form id="list_Form">
                                            <input type="hidden" name="itineraire_id" value="${item.id}" required>
                                            <span class="error itineraire_id_err"></span>
                                            <button type="submit" value="list_Form" class="px-3 py-2 bg-gray-800 text-white text-xs font-bold uppercase rounded">Add to visit list</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        `;
                        itineraireContainer.append(itinerary);
                    });
                },
                error: function(data){
                    console.log('Error:', data);
                }
            });
        });
        $(document).ready(function(){
            $('#list_Form').submit(function(event){
                event.preventDefault();
                var formData = $(this).serialize();
                // console.log(data);
                $.ajax({
                    url: "http://127.0.0.1:8080/api/itineraire/addList",
                    type: "POST",
                    headers: {'Authorization': localStorage.getItem('user_token')},
                    data: formData,
                    success: function(data){
                        console.log(data);
                        $(".result").text(data.success);
                    },
                    error: function(data){
                        console.log('Error:', data);
                    }
                });
            });
        });
    </script>
@endsection
